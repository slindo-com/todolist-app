<?php

includeModels(['Tasks', 'Lists']);
includeServices('List');

//
function listsControllerTodo($attributes) {
	$teamSlug = $attributes[0];
	$listSlug = $attributes[1];
	$todoId = $attributes[2];

	$navData = listsServiceGetNav($teamSlug, $listSlug);

	$todo = pdoGet(M_TASKS(), $todoId);

	if (actionEquals('update')) {

		pdoSetAttribute(M_TASKS(), $todo->id, 'title', $_POST['title']);
		header('Location: /' . $teamSlug . '/' . $listSlug . '/');

	} else if (actionEquals('delete')) {
		pdoDelete(M_TASKS(), $todo->id);
		listsModelChangeTaskCount($navData['list']->id, false);
		if ($todo->done) {
			listsModelChangeDoneCount($navData['list']->id, false);
		}
		header('Location: /' . $teamSlug . '/' . $listSlug . '/');
	}

	render("lists/todo", [
		'navData' => $navData,
		'todo' => $todo,
	]);
}

//
function listsControllerImportant() {
	echo 'TODO: LISTS: IMPORTANT';
}

//
function listsControllerToday() {
	echo 'TODO: LISTS: TODAY';
}

//
function listsControllerWeek() {
	echo 'TODO: LISTS: WEEK';
}

//
function listsControllerList($attributes) {
	$teamSlug = $attributes[0];
	$listSlug = $attributes[1];
	$showDone = !empty($attributes[2]);

	$navData = listsServiceGetNav($teamSlug, $listSlug);

	if ($navData['list']) {

		if (!empty($_POST['todo'])) {
			$newTaskCreated = true;
			tasksModelNew($navData['list']->id, $_POST['todo']);
			listsModelChangeTaskCount($navData['list']->id, true);
		}

		$navData = listsServiceGetNav($teamSlug, $listSlug);
		$tasks = tasksModelGetListTasks($navData['list']->id);
	}

	$tasksUndone = array_filter($tasks, function ($asset) {
		return empty($asset->done);
	}, ARRAY_FILTER_USE_BOTH);

	$tasksDone = array_filter($tasks, function ($asset) {
		return !empty($asset->done);
	}, ARRAY_FILTER_USE_BOTH);

	render("lists/list", [
		'navData' => $navData,
		'newTaskCreated' => !empty($newTaskCreated),
		'tasksUndone' => !empty($tasksUndone) ? $tasksUndone : [],
		'tasksDone' => !empty($tasksDone) ? $tasksDone : [],
		'showDone' => $showDone,
	]);
}

//
function listsControllerListShowDone($attributes) {
	$attributes[2] = 'done';
	listsControllerList($attributes);
}

//
function listsControllerAll($attributes) {
	$teamSlug = $attributes[0];

	render("lists/list", [
		'navData' => listsServiceGetNav($teamSlug, false),
		'tasks' => [],
	]);
}

//
function listsControllerCheckmark($attributes) {
	$taskId = $attributes[0];
	$task = pdoGet(M_TASKS(), $taskId);

	if (actionEquals('toggle')) {
		pdoSetAttribute(M_TASKS(), $taskId, 'done', ($task->done == 1 ? '0' : '1'));
		$task->done = ($task->done == 1 ? '0' : '1');

		listsModelChangeDoneCount($task->list, ($task->done == 1));
	}

	render("lists/checkmark", [
		'checked' => $task->done,
	]);
}
