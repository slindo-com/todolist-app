<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class TeamMembersAsset extends AbstractAsset {
	public $user;
	public $team;
	public $role;
}



class TeamMembersModel extends AbstractModel {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\TeamMembersAsset';
	protected $tableName = 'team_members';
}