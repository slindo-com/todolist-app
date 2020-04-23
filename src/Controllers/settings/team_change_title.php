<?php // ROUTE: /settings/teams/:team/edit-title/

F::verifyAuth();

$teamSlug = $attributes[0];
$team = F::dbFindOne(M::TEAMS(), ['slug' => $teamSlug]);

if (!empty($_POST['a']) && $_POST['a'] == 'edit-title') {
	$success = F::dbUpdate(M::TEAMS(), [$team->id => $_POST['title']]);

	if ($success) {
		$team = F::dbGet(M::TEAMS(), $team->id);
		header('Location: /settings/teams/' . $team->slug . '/');
	}
}

F::render('settings/edit-team-title', [
	'team' => $team,
]);
