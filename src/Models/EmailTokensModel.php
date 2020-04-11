<?php

function M_EMAIL_TOKENS() {
	return [
		'table' => 'email_tokens',
		'asset' => 'EmailTokensAsset',
	];
}

//
class EmailTokensAsset extends AbstractAsset {
	public $id;
	public $token;
	public $email;
	public $created_by;
	public $created_at;
}

//
function emailTokensModelNew($token, $email, $created_by) {
	$stmt = pdo()->prepare("INSERT INTO email_tokens (token, email, created_by) VALUES (:token, :email, :created_by)");
	$stmt->execute([
		'token' => $token,
		'email' => $email,
		'created_by' => $created_by,
	]);
	return empty($stmt->errorInfo()[1]);
}
