<?php

include_once __DIR__ . '/../Models/UsersModel.php';
include_once __DIR__ . '/../Models/PasswordResetsModel.php';

//
function authServiceVerifyAuth() {
	if (isset($_SESSION['auth'])) {
		return true;
	} else {
		header("Location: /sign-in/");
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
		session_regenerate_id(true);
		return true;
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
	$success = passwordResetsModelNew($token, $email, $_SESSION['auth']);

	return $success ? $token : false;
}

// TODO: Refactor completely to model
function authServiceGetResetToken($token) {
	return $this->passwordResetsModel->findByAttribute('token', $token);
}

//
function authServiceSignOut() {
	unset($_SESSION['auth']);
	session_regenerate_id(true);
	header("Location: /sign-in/");
	die();
}
