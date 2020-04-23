<?php
//
function SUB_TASKS() {
	return [
		'table' => 'sub_tasks',
		'asset' => 'SubTasksAsset',
	];
}
//
class SubTasksAsset extends AbstractAsset {
	public $id;
	public $task;
	public $title;
	public $done;
	public $created_by;
	public $created_at;
}
