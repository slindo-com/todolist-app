<?php

//
function LISTS() {
	return [
		'table' => 'lists',
		'asset' => 'ListsAsset',
	];
}

//
class ListsAsset extends AbstractAsset {
	public $id;
	public $team;
	public $title;
	public $created_by;
	public $created_at;
}