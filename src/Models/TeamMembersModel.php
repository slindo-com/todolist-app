<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class TeamMembersAsset extends AbstractAsset {
	public $id;
	public $user;
	public $team;
	public $role;
}



class TeamMembersModel extends TeamMembersAsset {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\TeamMembersAsset';
	protected $tableName = 'team_members';
}