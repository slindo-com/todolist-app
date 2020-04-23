<?php

//
function USERS() {
	return [
		'table' => 'users',
		'asset' => 'UsersAsset',
	];
}

//
class UsersAsset extends AbstractAsset {
	public $id;
	public $email;
	public $password;
	public $name;
	public $avatar;
	public $email_verified;
	public $created_at;
}