<?php

//
function TASKS() {
	return [
		'table' => 'tasks',
		'asset' => 'TasksAsset',
	];
}

//
class TasksAsset extends AbstractAsset {
	public $id;
	public $list;
	public $title;
	public $done;
	public $due;
	public $note;
	public $created_by;
	public $created_at;
}