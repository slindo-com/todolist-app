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



class PasswordResetsModel extends AbstractModel {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\PasswordResetsAsset';
	protected $tableName = 'password_resets';


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
}