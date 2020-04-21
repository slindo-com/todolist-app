<?php

includeModels(['Users', 'Invites', 'TeamMembers', 'PasswordResets']);
includeServices(['Auth', 'Mail', 'Translations']);
includeMails(['new-account', 'new-password']);

translationsGet(!empty($_SESSION['language']) ? $_SESSION['language'] : 'en');

//
function authControllerSignIn() {

	$error = false;

	if (actionEquals('sign-in')) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (authServiceAuth($email, $password)) {
			header('Location: /private/');
			return;
		} else {
			$error = getTranslation('error_combination');
		}
	}

	render('auth/sign-in', [
		'error' => $error,
	]);
}

//
function authControllerNewAccount($attributes) {

	$error = false;
	$token = $attributes[0];

	if($token) {
		$invite = pdoFindByAttribute(M_INVITES(), 'token', $token);
	}

	if (actionEquals('new-account')) {
		$email = !empty($invite) ? $invite->email : $_POST['email'];
		$password = $_POST['password'];

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = getTranslation('error_invalid_email');
		}

		if (strlen($password) < 6) {
			$error = getTranslation('error_short_password');
		}

		if(empty($error)) {
			try {
				authServiceNewAccount($email, $password);
			} catch(Exception $e) {
				if($e->getMessage() == 'DUPLICATE_EMAILS') {
					$error = getTranslation('error_duplicate_emails');
				} else {
					$error = getTranslation('error_database_error'). ' ('. $e->getMessage() .')';
				}
				
			}
		}

		if(empty($error) && !empty($invite)) {
			teamMembersModelNew($_SESSION['auth'], $invite->team);
			pdoDelete(M_INVITES(), $invite->id);
		}

		if(empty($error)) {
			$emailTemplate = EMAIL_NEW_ACCOUNT(CONFIG()['title']);

			mailServiceSend([
				'to' => $email,
				'subject' => $emailTemplate['subject'],
				'message' => $emailTemplate['message'],
			]);

			header('Location: '. (!empty($invite) ? '/settings/teams/' : '/private/'));
			return;
		}
	}

	render('auth/new-account', [
		'hasInvite' => !empty($invite),
		'inviteEmail' => !empty($invite) ? $invite->email : '',
		'error' => $error,
	]);
}

//
function authControllerNewPassword($attributes) {

	$error = false;
	$action = 'DEFAULT';

	if (actionEquals('send-instructions')) {
		$email = strtolower($_POST['email']);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = getTranslation('error_invalid_email');
		}

		$user = pdoFindByAttribute(M_USERS(), 'email', $email);

		if(empty($user)) {
			$error = getTranslation('error_user_email_not_found');
		}

		if(empty($error)) {
			$token = authServiceNewResetToken($email);
		}

		if (!empty($token)) {

			$emailTemplate = EMAIL_NEW_PASSWORD(CONFIG()['url'], $token);

			mailServiceSend([
				'to' => $email,
				'subject' => $emailTemplate['subject'],
				'message' => $emailTemplate['message'],
			]);
			$action = 'TOKEN_SENT';
		} else {
			$error = empty($error) ? getTranslation('error_token_not_created') : $error;
		}
	}

	if (!empty($attributes[0])) {
		$token = $attributes[0];
		$databaseToken = pdoFindByAttribute(M_PASSWORD_RESETS(), 'token', $token);
		$user = pdoFindByAttribute(M_USERS(), 'email', $databaseToken->email);

		if (actionEquals('set-password')) {
			if (!empty($databaseToken)) {
				usersModelSetPassword($user->id, $_POST['password']);
				pdoDelete(M_PASSWORD_RESETS(), $databaseToken->id);
				$action = 'PASSWORD_SET';
			} else {
				$action = 'TOKEN_NOT_VALID';
			}
		} else {
			if (!empty($databaseToken)) {
				$action = 'PASSWORD_FORM';
			} else {
				$action = 'TOKEN_NOT_VALID';
			}
		}
	}

	render('auth/new-password', [
		'action' => $action,
		'error' => $error,
	]);
}
