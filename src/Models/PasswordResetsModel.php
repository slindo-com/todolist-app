<?php

//
function M_PASSWORD_RESETS() {
	return [
		'table' => 'password_resets',
		'asset' => 'PasswordResetsAsset',
	];
}

//
class PasswordResetsAsset extends AbstractAsset {
	public $token;
	public $email;
	public $created_by;
	public $created_at;
}

//
function passwordResetsModelNew($token, $email) {
	$stmt = pdo()->prepare("INSERT INTO password_resets (token, email) VALUES (:token, :email)");
	$stmt->execute([
		'token' => $token,
		'email' => $email,
	]);

	return empty($stmt->errorInfo()[1]);
}
