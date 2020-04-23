<?php // ROUTE: /settings/teams/

F::verifyAuth();

if (F::actionEquals('new-team')) {
	teamsModelNew($_SESSION['auth']);
} else if (F::actionEquals('join-team')) {
	$invite = F::dbGet(M::INVITES(), $_POST['inviteId']);
	$user = F::dbGet(M::USERS(), $_SESSION['auth']);

	if ($invite->email == $user->email) {
		F::dbNew(M::TEAM_MEMBERS(), [
			'user' => $user->id,
			'team' => $invite->team,
			'role' => 2,
		]);
		F::dbDelete(M::INVITES(), $invite->id);
	}
} else if (F::actionEquals('decline-invitation')) {
	$invite = F::dbGet(M::INVITES(), $_POST['inviteId']);
	$user = F::dbGet(M::USERS(), $_SESSION['auth']);

	if ($invite->email == $user->email) {
		F::db_delete(M::INVITES(), $invite->id);
	}
}

$teams = F::teamsModelGetTeams($_SESSION['auth']);
$user = F::dbGet(M::USERS(), $_SESSION['auth']);
$invite = F::dbFindOne(M::INVITES(), ['email' => $user->email]);

if ($invite) {
	$invitingTeam = F::dbFindOne(M::TEAMS(), $invite->team);
}

$memberCounts = [];
foreach ($teams as $team) {
	$memberCounts[$team->id] = F::teamsModelGetMemberCount($team->id);
}

F::render('settings/teams', [
	'teams' => $teams,
	'memberCounts' => $memberCounts,
	'invite' => $invite,
	'invitingTeam' => !empty($invitingTeam) ? $invitingTeam : false,
]);
