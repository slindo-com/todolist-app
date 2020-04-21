<?php

includeModels(['EmailTokens', 'Invites', 'Teams', 'TeamMembers', 'Users']);
includeServices(['Auth', 'Mail', 'Translations']);
includeMails(['invite', 'change-email']);

translationsGet(!empty($_SESSION['language']) ? $_SESSION['language'] : 'en');

//
function settingsControllerIndex() {
	authServiceVerifyAuth();
	$user = pdoGet(M_USERS(), $_SESSION['auth']);

	if (actionEquals('edit-general')) {
		pdoSetAttribute(M_USERS(), $user->id, 'language', $_POST['language']);
		$user = pdoGet(M_USERS(), $_SESSION['auth']);

		if ($_SESSION['language'] != $user->language) {
			$_SESSION['language'] = $user->language;
			header('Location: /settings/');
		}
	}

	render('settings/index', [
		'user' => $user,
	]);
}

//
function settingsControllerTeams() {

	authServiceVerifyAuth();

	if (actionEquals('new-team')) {
		teamsModelNew($_SESSION['auth']);
	} else if (actionEquals('join-team')) {
		$invite = invitesModelFind($_POST['inviteId']);
		$user = pdoGet(M_USERS(), $_SESSION['auth']);

		if ($invite->email == $user->email) {
			teamMembersModelNew($user->id, $invite->team);
			pdoDelete(M_INVITES(), $invite->id);
		}
	} else if (actionEquals('decline-invitation')) {
		$invite = invitesModelFind($_POST['inviteId']);
		$user = pdoGet(M_USERS(), $_SESSION['auth']);

		if ($invite->email == $user->email) {
			pdoDelete(M_INVITES(), $invite->id);
		}
	}

	$teams = teamsModelGetTeams($_SESSION['auth']);
	$user = pdoGet(M_USERS(), $_SESSION['auth']);
	$invite = pdoFindByAttribute(M_INVITES(), 'email', $user->email);

	if ($invite) {
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
		'invitingTeam' => !empty($invitingTeam) ? $invitingTeam : false,
	]);
}

//
function settingsControllerTeam($attributes) {

	authServiceVerifyAuth();

	$teamSlug = $attributes[0];

	$team = pdoFindByAttribute(M_TEAMS(), 'slug', $teamSlug);
	$members = usersModelGetTeamMembers($team->id);
	$invites = invitesModelGetTeamInvites($team->id);

	render("settings/team", [
		'team' => $team,
		'members' => $members,
		'invites' => $invites,
	]);
}

//
function settingsControllerEditTeamTitle($attributes) {

	authServiceVerifyAuth();

	$teamSlug = $attributes[0];
	$team = pdoFindByAttribute(M_TEAMS(), 'slug', $teamSlug);

	if (!empty($_POST['a']) && $_POST['a'] == 'edit-title') {
		$success = teamsModelUpdateTitle($team->id, $_POST['title']);

		if ($success) {
			$team = pdoGet(M_TEAMS(), $team->id);
			header("Location: /settings/teams/" . $team->slug . "/");
		}
	}

	render("settings/edit-team-title", [
		'team' => $team,
	]);
}

//
function settingsControllerInviteTeamMember($attributes) {

	authServiceVerifyAuth();

	$teamSlug = $attributes[0];
	$team = pdoFindByAttribute(M_TEAMS(), 'slug', $teamSlug);

	if (actionEquals('send-invitation')) {
		$token = bin2hex(random_bytes(50));
		$success = invitesModelNew($team->id, $_POST['email'], $_POST['name'], $token);

		if ($success) {

			$user = pdoFindByAttribute(M_USERS(), 'email', strtolower($_POST['email']));

			if (!$user) {

				$emailTemplate = EMAIL_INVITE(CONFIG()['title'], CONFIG()['url'], $token);

				mailServiceSend([
					'to' => $_POST['email'],
					'subject' => $emailTemplate['subject'],
					'message' => $emailTemplate['message'],
				]);
			}

			header("Location: /settings/teams/" . $team->slug . "/");
		}
	}

	render("settings/invite-team-member", [
		'team' => $team,
	]);
}

//
function settingsControllerAccount($attributes, $query) {

	authServiceVerifyAuth();

	$user = pdoGet(M_USERS(), $_SESSION['auth']);

	if (actionEquals('sign-out')) {
		authServiceSignOut();
	} else if (actionEquals('save-name')) {
		$updateNameSuccess = pdoSetAttribute(M_USERS(), $user->id, 'name', $_POST['name']);
		$user->name = $_POST['name'];

		if ($updateNameSuccess) {
			$query['success'] = 'change-name';
		}
	}

	render("settings/account", [
		'user' => $user,
		'success' => !empty($query['success']) ? $query['success'] : false,
	]);
}

//
function settingsControllerChangeEmail() {

	authServiceVerifyAuth();

	$user = pdoGet(M_USERS(), $_SESSION['auth']);

	if (actionEquals('change-email')) {
		$token = bin2hex(random_bytes(50));

		$success = emailTokensModelNew($token, $_POST['email'], $_SESSION['auth']);

		if ($success) {

			$emailTemplate = EMAIL_CHANGE_EMAIL(CONFIG()['title'], CONFIG()['url'], $token);

			mailServiceSend([
				'to' => $_POST['email'],
				'subject' => $emailTemplate['subject'],
				'message' => $emailTemplate['message'],
			]);
			header("Location: /settings/account/?success=change-email");
		} else {
			$error = 'Please try another email address!';
		}
	}

	render("settings/account-change-email", [
		'user' => $user,
		'error' => !empty($error) ? $error : false,
	]);
}

//
function settingsControllerChangeEmailToken($attributes) {

	$token = $attributes[0];
	$tokenAsset = pdoFindByAttribute(M_EMAIL_TOKENS(), 'token', $token);

	if ($tokenAsset) {
		pdoSetAttribute(M_USERS(), $tokenAsset->created_by, 'email', strtolower($tokenAsset->email));
		pdoDelete(M_EMAIL_TOKENS(), $tokenAsset->id);
		header("Location: /settings/account/?success=change-email-success");
	} else {
		header("Location: /sign-in/");
	}
}

//
function settingsControllerChangePassword() {

	authServiceVerifyAuth();

	$user = pdoGet(M_USERS(), $_SESSION['auth']);

	if (actionEquals('change-password')) {
		if (password_verify($_POST['old-password'], $user->password)) {
			$encryptedPassword = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
			pdoSetAttribute(M_USERS(), $user->id, 'password', $encryptedPassword);
			header("Location: /settings/account/?success=change-password");
		} else {
			$error = 'Your old password was wrong. Please try again.';
		}
	}

	render("settings/account-change-password", [
		'user' => $user,
		'error' => !empty($error) ? $error : false,
	]);
}

//
function settingsControllerChangePic() {

	authServiceVerifyAuth();

	$user = pdoGet(M_USERS(), $_SESSION['auth']);

	if (actionEquals('change-picture')) {

		$picName = bin2hex(random_bytes(10));
		$picNameParts = explode('.', $_FILES['pic']['name']);
		$picType = end($picNameParts);
		$uploadfile = __DIR__ . '/../../public/pics/' . $picName . '.' . $picType;

		move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile);

		pdoSetAttribute(M_USERS(), $user->id, 'pic', $picName . '.' . $picType);

		header("Location: /settings/account/?success=change-pic");
	}

	render("settings/account-change-pic", [
		'user' => $user,
		'error' => !empty($error) ? $error : false,
	]);
}
