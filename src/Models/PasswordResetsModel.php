<?php

function M_PASSWORD_RESETS() {
	return [ 
		'table' => 'password_resets', 
		'asset' => 'PasswordResetsAsset'
	];
}

class PasswordResetsAsset extends AbstractAsset {
	public $token;
	public $email;
	public $created_by;
	public $created_at;
}



function passwordResetsModelNew($token, $email, $created_by) {
	$stmt = pdo()->prepare("INSERT INTO password_resets (token, email, created_by) VALUES (:token, :email, :created_by)");
	$stmt->execute([
		'token' => $token,
		'email' => $email,
		'created_by' => $created_by
	]);

	return empty($stmt->errorInfo()[1]);
}
