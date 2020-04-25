<?php // ROUTE: /:team/

F::verifyAuth();

$teamSlug = $attributes[0];

$navData = F::getNav($teamSlug, false);

if (F::actionEquals('new-list')) {
	$slug = F::listsModelNew($teamSlug == 'private'
		? false
		: F::dbFindOne(M::TEAMS(), ['slug' => $teamSlug])->id);
	header('Location: /' . $teamSlug . '/' . $slug . '/');
}

if (sizeof($navData['lists']) > 0) {
	header('Location: /' . $teamSlug . '/' . $navData['lists'][0]->slug . '/');
}

F::render('lists/overview', [
	'navData' => $navData,
	'tasks' => [],
]);
