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

	public function new($userId, $teamId) {
		$tableName = $this->tableName;
		$stmt = $this->pdo->prepare(
			"INSERT INTO $tableName (user, team, role) VALUES (:user, :team, :role)"
		);
		$stmt->execute([
			'user' => $userId,
			'team' => $teamId,
			'role' => 2
		]);
		return empty($stmt->errorInfo()[1]);
	}
}