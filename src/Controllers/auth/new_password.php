<?php
// ROUTE: /new-password/
// ROUTE: /new-password/:token/

$error = false;
$action = 'DEFAULT';

if (F::actionEquals('send-instructions')) {
	$email = strtolower($_POST['email']);

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = F::translationGet('error_invalid_email');
	}

	$user = F::dbFindOne(M::USERS(), ['email' => $email]);

	if (empty($user)) {
		$error = F::translationGet('error_user_email_not_found');
	}

	if (empty($error)) {
		$token = F::ewResetToken($email);
	}

	if (!empty($token)) {

		$emailTemplate = MAIL::NEW_PASSWORD(CONFIG()['url'], $token);

		F::sendMail([
			'to' => $email,
			'subject' => $emailTemplate['subject'],
			'message' => $emailTemplate['message'],
		]);
		$action = 'TOKEN_SENT';
	} else {
		$error = empty($error) ? F::translationGet('error_token_not_created') : $error;
	}
}

if (!empty($attributes[0])) {
	$token = $attributes[0];
	$databaseToken = F::dbFindOne(M::PASSWORD_RESETS(), ['token' => $token]);
	$user = F::dbFindOne(M::USERS(), ['email' => $databaseToken->email]);

	if (F::actionEquals('set-password')) {
		if (!empty($databaseToken)) {

			F::dbUpdate(M::USERS(), $user->id, ['password' => password_hash($_POST['password'], PASSWORD_BCRYPT)]);
			F::dbDelete(M::PASSWORD_RESETS(), $databaseToken->id);
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

F::render('auth/new-password', [
	'action' => $action,
	'error' => $error,
]);