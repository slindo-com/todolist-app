<?php

//
function INVITES() {
	return [
		'table' => 'invites',
		'asset' => 'InvitesAsset',
	];
}

//
class InvitesAsset extends AbstractAsset {
	public $id;
	public $token;
	public $team;
	public $email;
	public $name;
	public $created_by;
	public $created_at;
}