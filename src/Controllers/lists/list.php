<?php // ROUTE: /:team/:list/

F::verifyAuth();

$teamSlug = $attributes[0];
$listSlug = $attributes[1];
$showDone = !empty($attributes[2]);

$navData = F::getNav($teamSlug, $listSlug);

if ($navData['list']) {

	if (!empty($_POST['todo'])) {
		$newTaskCreated = true;
		F::dbNew(M::TASKS(), [
			'list' => $navData['list']->id,
			'title' => $_POST['todo'],
			'created_by' => $_SESSION['auth'],
		]);

		F::listsModelChangeTaskCount($navData['list']->id, true);
	} else if (F::actionEquals('make-important')) {
		F::dbUpdate(M::TASKS(), $_POST['taskId'], ['important' => '1']);
	} else if (F::actionEquals('make-unimportant')) {
		F::dbUpdate(M::TASKS(), $_POST['taskId'], ['important' => '0']);
	}

	$navData = F::getNav($teamSlug, $listSlug);
	$tasks = F::dbFindAll(M::TASKS(), ['list' => $navData['list']->id]);
}

$tasksUndone = array_filter($tasks, function ($asset) {
	return empty($asset->done);
}, ARRAY_FILTER_USE_BOTH);

usort($tasksUndone, function ($a, $b) {
	return $b->important - $a->important;
});

$tasksDone = array_filter($tasks, function ($asset) {
	return !empty($asset->done);
}, ARRAY_FILTER_USE_BOTH);

F::render('lists/list', [
	'navData' => $navData,
	'newTaskCreated' => !empty($newTaskCreated),
	'tasksUndone' => !empty($tasksUndone) ? $tasksUndone : [],
	'tasksDone' => !empty($tasksDone) ? $tasksDone : [],
	'showDone' => $showDone,
]);
