<?php

namespace App\Core;

use PDO;


abstract class AbstractModel {


  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }


  public function all() {   
     $table = $this->tableName;
     $asset = $this->assetName;
     $stmt = $this->pdo->query("SELECT * FROM `$table`");
     $posts = $stmt->fetchAll(PDO::FETCH_CLASS, $asset);
     return $posts;
  }


  public function find($id) {
    $table = $this->tableName;
    $asset = $this->assetName;
    $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $asset);
    $post = $stmt->fetch(PDO::FETCH_CLASS);

    return $post;
  }
}