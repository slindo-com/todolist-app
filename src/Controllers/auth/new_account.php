<?php
// ROUTE: /new-account/
// ROUTE: /new-account/:token/

$error = false;
$token = !empty($attributes[0]) ? $attributes[0] : false;

if ($token) {
	$invite = F::dbFindOne(M::INVITES(), ['token' => $token]);
}

if (F::actionEquals('new-account')) {
	$email = !empty($invite) ? $invite->email : $_POST['email'];
	$password = $_POST['password'];

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = F::translationGet('error_invalid_email');
	}

	if (strlen($password) < 6) {
		$error = F::translationGet('error_short_password');
	}

	if (empty($error)) {
		try {
			F::newAccount($email, $password);
		} catch (Exception $e) {
			if ($e->getMessage() == 'DUPLICATE') {
				$error = F::translationGet('error_duplicate_emails');
			} else {
				$error = F::translationGet('error_database_error') . ' (' . $e->getMessage() . ')';
			}

		}
	}

	if (empty($error) && !empty($invite)) {
		F::dbNew(M::TEAM_MEMBERS(), [
			'user' => $_SESSION['auth'],
			'team' => $invite->team,
			'role' => 2,
		]);
		F::dbDelete(M::INVITES(), $invite->id);
	}

	if (empty($error)) {
		$emailTemplate = MAIL::NEW_ACCOUNT(CONFIG()['title']);

		F::sendMail([
			'to' => $email,
			'subject' => $emailTemplate['subject'],
			'message' => $emailTemplate['message'],
		]);

		header('Location: ' . (!empty($invite) ? '/settings/teams/' : '/private/'));
		return;
	}
}

F::render('auth/new-account', [
	'hasInvite' => !empty($invite),
	'inviteEmail' => !empty($invite) ? $invite->email : '',
	'error' => $error,
]);
