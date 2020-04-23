<?php

//
function PASSWORD_RESETS() {
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