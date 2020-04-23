<?php

function EMAIL_TOKENS() {
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