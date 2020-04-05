<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class UsersAsset extends AbstractAsset {
	public $id;
	public $email;
	public $password;
	public $name;
	public $avatar;
	public $email_verified;
	public $created_at;
}



class UsersModel extends AbstractModel {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\UsersAsset';
	protected $tableName = 'users';
	protected $joinTableName = 'team_members';


	public function new($email, $password) {
		$table = $this->tableName;
		$stmt = $this->pdo->prepare(
			"INSERT INTO `$table` (`email`, `password`) VALUES (:email,:password)"
		);
		$success = $stmt->execute([
			'email' => $email,
			'password' => $password
		]);

		if(empty($stmt->errorInfo()[1])) {
			return $this->pdo->lastInsertId();
		} else {
			return false;
		}
	}
	

	public function setPassword($password) {
		$table = $this->tableName;

		$stmt = $this->pdo->prepare("UPDATE `{$table}` SET `password` = :password WHERE `id` = :id");
		$stmt->execute([
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'id' => $_SESSION['auth']
		]);
	}


	public function getTeamMembers($teamId) {
		$table = $this->tableName;
		$joinTable = $this->joinTableName;
		$asset = $this->assetName;
		$stmt = $this->pdo->prepare(
			"SELECT * FROM $table LEFT JOIN $joinTable ON $table.id = $joinTable.user WHERE $joinTable.team = :teamId"
		);
		$stmt->execute(['teamId' => $teamId]);
		$posts = $stmt->fetchAll(PDO::FETCH_CLASS, $asset);
		return $posts;
	}
}