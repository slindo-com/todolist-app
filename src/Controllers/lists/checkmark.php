<?php // ROUTE: /checkmark/:task/

F::verifyAuth();

$taskId = $attributes[0];
$task = F::dbGet(M::TASKS(), $taskId);

if (F::actionEquals('toggle')) {
	F::dbUpdate(M::TASKS(), $taskId, ['done' => ($task->done == 1 ? '0' : '1')]);
	$task->done = ($task->done == 1 ? '0' : '1');

	F::listsModelChangeDoneCount($task->list, ($task->done == 1));
}

F::render('lists/checkmark', [
	'checked' => $task->done,
]);
