<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class ListsAsset extends AbstractAsset {
	public $id;
	public $title;
	public $created_by;
	public $created_at;
	public $team;
	public $user;
}



class ListsModel extends ListsAsset {
	
	protected $pdo;
	private $assetName = 'App\\Models\\ListsAsset';
	private $tableName = 'invites';
}