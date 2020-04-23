<?php
function newAccount($email, $password) {

	$encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
	$lowerCaseEmail = strtolower($email);

	$lastId = F::dbNew(M::USERS(), [
		'email' => $lowerCaseEmail,
		'password' => $encryptedPassword,
	]);

	if ($lastId != 0) {
		$_SESSION['auth'] = $lastId;
		$_SESSION['language'] = 'en';
		session_regenerate_id(true);
		return false;
	} else {
		return false;
	}
}