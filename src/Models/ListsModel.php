<?php

//
function M_LISTS() {
	return [
		'table' => 'lists',
		'asset' => 'ListsAsset',
	];
}

//
class ListsAsset extends AbstractAsset {
	public $id;
	public $team;
	public $title;
	public $created_by;
	public $created_at;
}

//
function listsModelGetUserLists($userId) {
	$stmt = pdo()->prepare('SELECT * FROM lists WHERE created_by = :created_by AND team = 0');
	$stmt->execute(['created_by' => $userId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M_LISTS()['asset']);
}