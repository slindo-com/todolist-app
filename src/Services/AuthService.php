<?php

includeModels(['PasswordResets', 'Users']);

//
function authServiceVerifyAuth() {
	if (isset($_SESSION['auth'])) {
		return true;
	} else {
		header('Location: /sign-in/');
		die();
	}
}

//
function authServiceAuth($email, $password) {
	$user = pdoFindByAttribute(M_USERS(), 'email', $email);
	if (empty($user)) {
		return false;
	}

	if (password_verify($password, $user->password)) {
		$_SESSION['auth'] = $user->id;
		$_SESSION['language'] = $user->language;
		session_regenerate_id(true);
		return true;
	} else {
		return false;
	}
}

//
function authServiceNewAccount($email, $password) {

	$encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
	$lowerCaseEmail = strtolower($email);

	$lastId = usersModelNew($lowerCaseEmail, $encryptedPassword);

	if ($lastId != 0) {
		$_SESSION['auth'] = $lastId;
		$_SESSION['language'] = 'en';
		session_regenerate_id(true);
		return false;
	} else {
		return false;
	}
}

//
function authServiceSetPassword($password) {
	return usersModelSetPassword($password);
}

//
function authServiceNewResetToken($email) {
	$token = bin2hex(random_bytes(50));
	$success = passwordResetsModelNew($token, $email);

	return $success ? $token : false;
}

//
function authServiceSignOut() {
	unset($_SESSION['auth']);
	session_regenerate_id(true);
	header('Location: /sign-in/');
	die();
}
