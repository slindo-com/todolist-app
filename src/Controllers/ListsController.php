<?php

includeModels(['Tasks']);
includeServices('List');


function listsControllerTodo($attributes) {
	$teamSlug = $attributes[0];
	$listSlug = $attributes[1];
	$todoId = $attributes[2];

	$navData = listsServiceGetNav($teamSlug, $listSlug);

	$todo = pdoGet(M_TASKS(), $todoId);

	if(actionEquals('update')) {

		pdoSetAttribute(M_TASKS(), $todo->id, 'title', $_POST['title']);
		header('Location: /'. $teamSlug .'/'. $listSlug .'/');

	} else if(actionEquals('delete')) {
		pdoDelete(M_TASKS(), $todo->id);
		header('Location: /'. $teamSlug .'/'. $listSlug .'/');
	}


	render("lists/todo", [
		'navData' => $navData,
		'todo' => $todo
	]);
}



function listsControllerImportant() {
	echo 'TODO: LISTS: IMPORTANT';
}



function listsControllerToday() {
	echo 'TODO: LISTS: TODAY';
}



function listsControllerWeek() {
	echo 'TODO: LISTS: WEEK';
}



function listsControllerList($attributes) {
	$teamSlug = $attributes[0];
	$listSlug = $attributes[1];

	$navData = listsServiceGetNav($teamSlug, $listSlug);

	if($navData['list']) {

		if(!empty($_POST['todo'])) {
			$newTaskCreated = true;
			tasksModelNew($navData['list']->id, $_POST['todo']);
		}

		$tasks = tasksModelGetListTasks($navData['list']->id);
	}

	render("lists/list", [
		'navData' => $navData,
		'newTaskCreated' => !empty($newTaskCreated),
		'tasks' => !empty($tasks) ? $tasks : []
	]);
}



function listsControllerAll($attributes) {
	$teamSlug = $attributes[0];

	render("lists/list", [
		'navData' => listsServiceGetNav($teamSlug, false),
		'tasks' => []
	]);
}



function listsControllerCheckmark($attributes) {
	$taskId = $attributes[0];
	$task = pdoGet(M_TASKS(), $taskId);

	if(actionEquals('toggle')) {
		pdoSetAttribute(M_TASKS(), $taskId, 'done', ($task->done == 1 ? '0' : '1'));
		$task->done = ($task->done == 1 ? '0' : '1');
	}


	render("lists/checkmark", [
		'checked' => $task->done
	]);
}


