<?php

namespace App\Auth;

use App\Core\AbstractRepository;
use PDO;

class PasswordResetsRepository extends AbstractRepository {

  public function getModelName() {
    return "App\\Auth\\PasswordResetsModel";
  }

  public function getTableName() {
    return "password_resets";
  }

  public function new($token, $email, $created_by) {
    $table = $this->getTableName();
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
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE token = :token");

    $stmt->execute(['token' => $token]);
    $databaseToken = $stmt->fetch(PDO::FETCH_ASSOC);

    return $databaseToken;
  }
}
?>