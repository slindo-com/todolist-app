<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class CommentsAsset extends AbstractAsset {
	public $id;
	public $comment;
	public $created_by;
	public $created_at;
	public $task;
}



class CommentsModel extends CommentsAsset {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\CommentsAsset';
	protected $tableName = 'comments';
}