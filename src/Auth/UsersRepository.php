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

  public function new($email, $password) {
      $table = $this->getTableName();
      $stmt = $this->pdo->prepare(
        "INSERT INTO `$table` (`email`, `password`) VALUES (:email, :password)"
      );
      $success = $stmt->execute([
        'email' => $email,
        'password' => $password
      ]);

      if($success) {
        return $this->pdo->lastInsertId();
      } else {
        return 0;
      }
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

  public function setPassword($userId, $password) {
    $table = $this->getTableName();

    $stmt = $this->pdo->prepare("UPDATE `{$table}` SET `password` = :password WHERE `id` = :id");
    $stmt->execute([
      'password' => $password,
      'id' => $userId
    ]);
  }
}
?>