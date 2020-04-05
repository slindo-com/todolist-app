<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

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



class TasksModel extends AbstractModel {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\TasksAsset';
	protected $tableName = 'tasks';
}