<?php // ROUTE: /:team/:list/:task/

F::verifyAuth();

$teamSlug = $attributes[0];
$listSlug = $attributes[1];
$todoId = $attributes[2];

$navData = F::getNav($teamSlug, $listSlug);

$todo = F::dbGet(M::TASKS(), $todoId);

if (F::actionEquals('update')) {

	F::dbUpdate(M::TASKS(), $todo->id, ['title' => $_POST['title']]);
	header('Location: /' . $teamSlug . '/' . $listSlug . '/');

} else if (F::actionEquals('delete')) {
	F::dbDelete(M::TASKS(), $todo->id);
	F::listsModelChangeTaskCount($navData['list']->id, false);
	if ($todo->done) {
		F::listsModelChangeDoneCount($navData['list']->id, false);
	}
	header('Location: /' . $teamSlug . '/' . $listSlug . '/');
}

F::render('lists/todo', [
	'navData' => $navData,
	'todo' => $todo,
]);
