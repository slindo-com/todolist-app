<?php // ROUTE: /sign-in/

$error = false;

if (F::actionEquals('sign-in')) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (F::signIn($email, $password)) {
		header('Location: /private/');
		return;
	} else {
		$error = F::translationGet('error_combination');
	}
}

F::render('auth/sign-in', [
	'error' => $error,
]);
