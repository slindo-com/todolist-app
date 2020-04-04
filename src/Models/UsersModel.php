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
	private $assetName = 'App\\Models\\UsersAsset';
	private $tableName = 'users';


	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}


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


	public function findByEmail($email) {
		$table = $this->tableName;
		$asset = $this->assetName;
		$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE email = :email");
		
		$stmt->execute(['email' => $email]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, $asset);
		$user = $stmt->fetch(PDO::FETCH_CLASS);

		return $user;
	}
	

	public function setPassword($password) {
		$table = $this->tableName;

		$stmt = $this->pdo->prepare("UPDATE `{$table}` SET `password` = :password WHERE `id` = :id");
		$stmt->execute([
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'id' => $_SESSION['auth']
		]);
	}
}