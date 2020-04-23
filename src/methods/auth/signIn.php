<?php
function signIn($email, $password) {
	$user = F::dbFindOne(M::USERS(), ['email' => $email]);
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