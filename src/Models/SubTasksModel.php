<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class SubTasksAsset extends AbstractAsset {
	public $id;
	public $title;
	public $done;
	public $created_by;
	public $created_at;
	public $task;
}



class SubTasksModel extends SubTasksAsset {
	
	protected $pdo;
	private $assetName = 'App\\Models\\SubTasksAsset';
	private $tableName = 'sub_tasks';
}