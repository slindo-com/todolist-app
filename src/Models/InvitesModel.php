<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class InvitesAsset extends AbstractAsset {
	public $token;
	public $team;
	public $email;
	public $name;
	public $created_by;
	public $created_at;
}



class InvitesModel extends InvitesAsset {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\InvitesAsset';
	protected $tableName = 'invites';
}