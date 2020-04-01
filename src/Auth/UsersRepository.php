<?php

namespace App\Auth;

use App\Core\AbstractRepository;
use PDO;

class UsersRepository extends AbstractRepository {

  public function getModelName() {
    return "App\\Auth\\UserModel";
  }

  public function getTableName() {
    return "users";
  }

  public function findByEmail($email) {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
    $user = $stmt->fetch(PDO::FETCH_CLASS);

    return $user;
  }
}
?>