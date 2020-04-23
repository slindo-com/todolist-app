<?php
function newResetToken($email) {
	$token = bin2hex(random_bytes(50));
	$success = F::dbNew(M_PASSWORD_RESETS(), [
		'token' => $token,
		'email' => $email,
	]);

	return $success ? $token : false;
}