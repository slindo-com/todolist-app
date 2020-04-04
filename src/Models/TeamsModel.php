<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class TeamsAsset extends AbstractAsset {
	public $id;
	public $title;
	public $slug;
	public $created_by;
	public $created_at;
}



class TeamsModel extends TeamsAsset {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\TeamsAsset';
	protected $tableName = 'teams';
}