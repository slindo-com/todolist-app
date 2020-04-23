<?php // ROUTE: /:team/

F::verifyAuth();

$teamSlug = $attributes[0];

if (F::actionEquals('new-list')) {
	$slug = F::listsModelNew($teamSlug == 'private'
		? false
		: F::dbFindOne(M::TEAMS(), ['slug' => $teamSlug])->id);
	header('Location: /' . $teamSlug . '/' . $slug . '/');
}

F::render("lists/list", [
	'navData' => F::getNav($teamSlug, false),
	'tasks' => [],
]);
