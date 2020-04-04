<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class ListsAsset extends AbstractAsset {
	public $id;
	public $team;
	public $user;
	public $title;
	public $created_by;
	public $created_at;
}



class ListsModel extends ListsAsset {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\ListsAsset';
	protected $tableName = 'invites';
}