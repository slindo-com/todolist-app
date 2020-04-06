<?php

namespace App\Models;

use App\Core\AbstractAsset;
use App\Core\AbstractModel;

use PDO;

class TeamsAsset extends AbstractAsset {
	public $id;
	public $title;
	public $slug;
	public $created_by;
	public $created_at;
}



class TeamsModel extends AbstractModel {
	
	protected $pdo;
	protected $assetName = 'App\\Models\\TeamsAsset';
	protected $tableName = 'teams';
	protected $joinTableName = 'team_members';


	public function new($userId) {

		$baseSlug = 'new-team';
		$slug = $baseSlug;
		$count = 1;

		while (!$this->isSlugValid($slug)) {
			$slug = $baseSlug .'-'. $count;
			$count++;
		}

		$table = $this->tableName;
		$joinTableName = $this->joinTableName;
		$stmt = $this->pdo->prepare(
			"INSERT INTO $table (`slug`, `created_by`) VALUES (:slug, :created_by)"
		);

		$stmt2 = $this->pdo->prepare(
			"INSERT INTO $joinTableName (`user`, `team`, `role`) VALUES (:user, :team, :role)"
		);

		$this->pdo->beginTransaction();

		$stmt->execute([
			'slug' => $slug,
			'created_by' => $userId
		]);

		$teamId = $this->pdo->lastInsertId();

		$stmt2->execute([
			'user' => $userId,
			'team' => $teamId,
			'role' => 1
		]);

		if(empty($stmt->errorInfo()[1]) && empty($stmt2->errorInfo()[1])) {
			$this->pdo->commit();
			return true;
		} else {
			$this->pdo->rollBack();
			return false;
		}
	}


	public function updateTitle($teamId, $title) {
		$baseSlug = $this->createSlug($title);
		$slug = $baseSlug;
		$count = 1;

		while (!$this->isSlugValid($slug)) {
			$slug = $baseSlug .'-'. $count;
			$count++;
		}

		$table = $this->tableName;
		$stmt = $this->pdo->prepare("UPDATE {$table} SET title = :title, slug = :slug WHERE id = :id");
		$stmt->execute([
			'title' => $title,
			'slug' => $slug,
			'id' => $teamId
		]);

		return true;
	}


	public function isSlugValid($slug) {
		$hasSlug = $this->findByAttribute('slug', $slug);
		return $hasSlug ? false : true;
	}


	public function createSlug($str){
		return strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), '-'));
	} 
	

	public function getTeams($userId) {

		$table = $this->tableName;
		$joinTable = $this->joinTableName;
		$asset = $this->assetName;
		$stmt = $this->pdo->prepare(
			"SELECT * FROM $joinTable LEFT JOIN $table ON $table.id = $joinTable.team WHERE $joinTable.user = :userId"
		);
		$stmt->execute(['userId' => $userId]);
		$posts = $stmt->fetchAll(PDO::FETCH_CLASS, $asset);
		return $posts;
	}


	public function getMemberCount($teamId) {
		$joinTable = $this->joinTableName;
		$stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM $joinTable WHERE team = :team");
		$stmt->execute(['team' => $teamId]);
		$count = $stmt->fetch();

		return $count['count'];
	}
}