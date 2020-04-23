<?php

//
function TEAMS() {
	return [
		'table' => 'teams',
		'asset' => 'TeamsAsset',
	];
}

//
class TeamsAsset extends AbstractAsset {
	public $id;
	public $title;
	public $slug;
	public $created_by;
	public $created_at;
}