<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class TasksAsset extends AbstractAsset {
	public $id;
	public $title;
	public $done;
	public $created_by;
	public $created_at;
	public $due;
	public $note;
	public $list;
}



class TasksModel extends TasksAsset {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\TasksAsset';
	protected $tableName = 'tasks';
}