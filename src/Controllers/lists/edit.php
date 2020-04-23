<?php // ROUTE: /:team/:listId/edit/

F::verifyAuth();

$teamSlug = $attributes[0];
$listSlug = $attributes[1];
$navData = F::getNav($teamSlug, $listSlug);

if (F::actionEquals('edit-title')) {
	$teamId = $teamSlug == 'private' ? false : (F::dbFindOne(M::TEAMS(), ['slug' => $teamSlug]))->id;
	$slug = F::listsModelUpdateTitle($teamId, $_POST['listId'], $_POST['title']);
	header('Location: /' . $teamSlug . '/' . $slug . '/');
} else if (F::actionEquals('trash-list')) {
	F::dbUpdate(M::LISTS(), $_POST['listId'], ['trashed' => '1']);
	header('Location: /' . $teamSlug . '/');
}

F::render('lists/edit-list', [
	'navData' => $navData,
]);
