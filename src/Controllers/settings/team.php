<?php // ROUTE: /settings/teams/:team/

F::verifyAuth();

$teamSlug = $attributes[0];

$team = F::dbFindOne(M::TEAMS(), ['slug' => $teamSlug]);
$members = F::usersModelGetTeamMembers($team->id);
$invites = F::dbFindAll(M::INVITES(), ['team' => $team->id]);

F::render('settings/team', [
	'team' => $team,
	'members' => $members,
	'invites' => $invites,
]);
