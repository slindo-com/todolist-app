<?php // ROUTE: /:team/:list/

F::verifyAuth();

$teamSlug = $attributes[0];
$listSlug = $attributes[1];
$showDone = !empty($attributes[2]);

$navData = F::getNav($teamSlug, $listSlug);

if ($navData['list']) {

	$isSameList = strpos($_SERVER['HTTP_REFERER'], $teamSlug . '/' . $navData['list']->slug) && $attributes[2] != 'done';
	if (!$isSameList) {
		$_SESSION['sameListDone'] = [];
		$_SESSION['sameListImportant'] = [];
	}

	if (!empty($_POST['todo'])) {
		$newTaskCreated = true;
		F::dbNew(M::TASKS(), [
			'list' => $navData['list']->id,
			'title' => $_POST['todo'],
			'created_by' => $_SESSION['auth'],
		]);

		F::listsModelChangeTaskCount($navData['list']->id, true);
	} else if (F::actionEquals('toggle-important')) {

		$task = F::dbGet(M::TASKS(), $_POST['taskId']);
		if ($task->list == $navData['list']->id) {
			F::dbUpdate(M::TASKS(), $_POST['taskId'], ['important' => ($task->important == 1 ? '0' : '1')]);

			if (empty($_SESSION['sameListImportant'][$task->id])) {
				$_SESSION['sameListImportant'][$task->id] = true;
			} else {
				unset($_SESSION['sameListImportant'][$task->id]);
			}
		}

	} else if (F::actionEquals('toggle-done')) {
		$task = F::dbGet(M::TASKS(), $_POST['taskId']);
		if ($task->list == $navData['list']->id) {
			F::dbUpdate(M::TASKS(), $task->id, ['done' => ($task->done == 1 ? '0' : '1')]);
			F::listsModelChangeDoneCount($task->list, ($task->done == 1));
			if ($task->done !== 1) {
				$_SESSION['sameListDone'][$task->id] = true;
			} else {
				unset($_SESSION['sameListDone'][$task->id]);
			}
		}
	}

	$navData = F::getNav($teamSlug, $listSlug);
	$tasks = F::dbFindAll(M::TASKS(), ['list' => $navData['list']->id]);

	$tasksUndone = array_filter($tasks, function ($asset) {
		return empty($asset->done) || !empty($_SESSION['sameListDone'][$asset->id]);
	}, ARRAY_FILTER_USE_BOTH);

	usort($tasksUndone, function ($a, $b) {
		$bImportant = empty($_SESSION['sameListImportant'][$b->id]) ? $b->important : empty($b->important);
		$aImportant = empty($_SESSION['sameListImportant'][$a->id]) ? $a->important : empty($a->important);
		return $bImportant - $aImportant;
	});

	$tasksDone = array_filter($tasks, function ($asset) {
		return !empty($asset->done) && empty($_SESSION['sameListDone'][$asset->id]);
	}, ARRAY_FILTER_USE_BOTH);

	if (sizeof($tasksDone) == 0 && $attributes[2] == 'done') {
		header('Location: /' . $teamSlug . '/' . $listSlug . '/');
		die();
	}

	F::render('lists/list', [
		'navData' => $navData,
		'newTaskCreated' => !empty($newTaskCreated),
		'tasksUndone' => !empty($tasksUndone) ? $tasksUndone : [],
		'tasksDone' => !empty($tasksDone) ? $tasksDone : [],
		'showDone' => $showDone,
	]);
}