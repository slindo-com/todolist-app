<?php

includeModels(['Invites', 'Teams', 'TeamMembers', 'Users']);
includeServices(['Auth', 'Mail']);



function settingsControllerIndex() {
	authServiceVerifyAuth();
	render("settings/index", []);
}



function settingsControllerTeams() {
	authServiceVerifyAuth();

	if(!empty($_POST['a']) && $_POST['a'] == 'new-team') {
		teamsModelNew($_SESSION['auth']);
	} else if(!empty($_POST['a']) && $_POST['a'] == 'join-team') {
		$invite = invitesModelFind($_POST['inviteId']);
		$user = pdoGet(M_USERS(), $_SESSION['auth']);

		if($invite->email == $user->email) {
			teamMembersModelNew($user->id, $invite->team);
			invitesModelDelete($invite->id);
		}		
	} else if(!empty($_POST['a']) && $_POST['a'] == 'decline-invitation') {
		$invite = invitesModelFind($_POST['inviteId']);
		$user = pdoGet(M_USERS(), $_SESSION['auth']);

		if($invite->email == $user->email) {
			invitesModelDelete($invite->id);
		}
	}

	$teams = teamsModelGetTeams($_SESSION['auth']);
	$user = pdoGet(M_USERS(), $_SESSION['auth']);
	$invite = pdoFindByAttribute(M_INVITES(), 'email', $user->email);

	if($invite) {
		$invitingTeam = teamsModelFind($invite->team);
	}

	$memberCounts = [];
	foreach ($teams as $team) {
		$memberCounts[$team->id] = teamsModelGetMemberCount($team->id);
	}

	render("settings/teams", [
		'teams' => $teams,
		'memberCounts' => $memberCounts,
		'invite' => $invite,
		'invitingTeam' => !empty($invitingTeam) ? $invitingTeam : false
	]);
}

function settingsControllerTeam($attributes) {
	authServiceVerifyAuth();

	$teamSlug = $attributes[0];

	$team = pdoFindByAttribute(M_TEAMS(), 'slug', $teamSlug);
	$members = usersModelGetTeamMembers($team->id);
	$invites = invitesModelGetTeamInvites($team->id);

	render("settings/team", [
		'team' => $team,
		'members' => $members,
		'invites' => $invites
	]);
}


function settingsControllerEditTeamTitle($attributes) {
	authServiceVerifyAuth();

	$teamSlug = $attributes[0];
	$team = pdoFindByAttribute(M_TEAMS(), 'slug', $teamSlug);

	if(!empty($_POST['a']) && $_POST['a'] == 'edit-title') {
		$success = teamsModelUpdateTitle($team->id, $_POST['title']);

		if($success) {
			$team = pdoGet(M_TEAMS(), $team->id);
			header("Location: /settings/teams/". $team->slug ."/");
		}
	}

	render("settings/edit-team-title", [
		'team' => $team
	]);
}


function settingsControllerInviteTeamMember($attributes) {
	authServiceVerifyAuth();

	$teamSlug = $attributes[0];
	$team = pdoFindByAttribute(M_TEAMS(), 'slug', $teamSlug);

	if(!empty($_POST['a']) && $_POST['a'] == 'send-invitation') {
		$token = bin2hex(random_bytes(50));
		$success = invitesModelNew($team->id, $_POST['email'], $_POST['name'], $token);

		if($success) {

			$user = pdoFindByAttribute(M_USERS(), 'email', strtolower($_POST['email']));

			if(!$user) {
				mailServiceSend([
					'to' => $_POST['email'],
					'subject' => 'Invite to Team on Todolist One',
					'message' => 'Invite to Team on Todolist One: '. $token
				]);
			}

			header("Location: /settings/teams/". $team->slug ."/");
		}
	}

		render("settings/invite-team-member", [
			'team' => $team
		]);
	}


function settingsControllerAccount() {
	authServiceVerifyAuth();
		
	if(!empty($_POST['a']) && $_POST['a'] == 'sign-out') {
		authServiceSignOut();
	}
	render("settings/account", []);
}



function settingsControllerChangeEmail() {
	echo 'TODO: SETTINGS: CHANGE EMAIL';
}



function settingsControllerChangePassword() {
	echo 'TODO: SETTINGS: CHANGE PASSWORD';
}


