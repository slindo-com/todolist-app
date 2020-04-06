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
		return $this->findByAttribute('id', $id);
	}


	public function findByAttribute($attribute, $value) {
		$table = $this->tableName;
		$asset = $this->assetName;
		$stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $attribute = :value");
		$stmt->execute(['value' => $value]);

		$stmt->setFetchMode(PDO::FETCH_CLASS, $asset);
		$post = $stmt->fetch(PDO::FETCH_CLASS);

		return $post;
	}


	public function delete($id) {
		$table = $this->tableName;
		$stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
		$stmt->execute(['id' => $id]);
		return empty($stmt->errorInfo()[1]);
	}
}