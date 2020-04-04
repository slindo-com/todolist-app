<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class TeamsAsset extends AbstractAsset {
	public $id;
	public $title;
	public $created_by;
	public $created_at;
}



class TeamsModel extends TeamsAsset {
	
	protected $pdo;
	private $assetName = 'App\\Models\\TeamsAsset';
	private $tableName = 'teams';
}