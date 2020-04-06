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



class InvitesModel extends AbstractModel {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\InvitesAsset';
	protected $tableName = 'invites';

	public function new($teamId, $email, $name, $token) {

		$table = $this->tableName;
		$stmt = $this->pdo->prepare(
			"INSERT INTO $table (token, team, email, name, created_by) VALUES (:token, :team, :email, :name, :created_by)"
		);
		$stmt->execute([
			'token' => $token,
			'team' => $teamId,
			'email' => $email,
			'name' => $name,
			'created_by' => $_SESSION['auth']
		]);

		return empty($stmt->errorInfo()[1]);
	}


	public function getTeamInvites($teamId) {

		$table = $this->tableName;
		$asset = $this->assetName;
		$stmt = $this->pdo->prepare(
			"SELECT * FROM $table WHERE team = :teamId"
		);
		$stmt->execute(['teamId' => $teamId]);
		$posts = $stmt->fetchAll(PDO::FETCH_CLASS, $asset);
		return $posts;
	}
}