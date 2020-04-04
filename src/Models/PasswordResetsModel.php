<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class PasswordResetsAsset extends AbstractAsset {
	public $token;
	public $email;
	public $created_by;
	public $created_at;
}



class PasswordResetsModel extends PasswordResetsAsset {
	
	protected $pdo;
	private $assetName = 'App\\Models\\PasswordResetsAsset';
	private $tableName = 'password_resets';


	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}


	public function new($token, $email, $created_by) {
		$table = $this->tableName;
		$stmt = $this->pdo->prepare(
			"INSERT INTO `$table` (`token`, `email`, `created_by`) VALUES (:token, :email, :created_by)"
		);
		$stmt->execute([
			'token' => $token,
			'email' => $email,
			'created_by' => $created_by
		]);

		if(empty($stmt->errorInfo()[1])) {
			return true;
		} else {
			return false;
		}
	}


	public function getToken($token) {
		$table = $this->tableName;
		$asset = $this->assetName;
		$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE token = :token");

		$stmt->execute(['token' => $token]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, $asset);
		$post = $stmt->fetch(PDO::FETCH_CLASS);

		return $post;
	}
}