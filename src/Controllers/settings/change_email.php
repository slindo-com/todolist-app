<?php // ROUTE: /settings/account/change-email/

F::verifyAuth();

$user = F::dbGet(M::USERS(), $_SESSION['auth']);

if (F::actionEquals('change-email')) {
	$token = bin2hex(random_bytes(50));

	$success = F::dbNew(M::EMAIL_TOKENS(), [
		'email' => $_POST['email'],
		'created_by' => $_SESSION['auth'],
	]);

	if ($success) {

		$emailTemplate = MAIL::CHANGE_EMAIL(CONFIG()['title'], CONFIG()['url'], $token);

		F::sendMail([
			'to' => $_POST['email'],
			'subject' => $emailTemplate['subject'],
			'message' => $emailTemplate['message'],
		]);
		header('Location: /settings/account/?success=change-email');
	} else {
		$error = 'Please try another email address!';
	}
}

F::render('settings/account-change-email', [
	'user' => $user,
	'error' => !empty($error) ? $error : false,
]);
