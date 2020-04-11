<?php

//
function M_TASKS() {
	return [
		'table' => 'tasks',
		'asset' => 'TasksAsset',
	];
}

//
class TasksAsset extends AbstractAsset {
	public $id;
	public $list;
	public $title;
	public $done;
	public $due;
	public $note;
	public $created_by;
	public $created_at;
}

//
function tasksModelGetListTasks($listId) {
	$stmt = pdo()->prepare('SELECT * FROM tasks WHERE list = :list');
	$stmt->execute(['list' => $listId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M_TASKS()['asset']);
}

//
function tasksModelNew($listId, $title) {
	$stmt = pdo()->prepare('INSERT INTO tasks (list, title, created_by) VALUES (:list, :title, :created_by)');
	$success = $stmt->execute([
		'list' => $listId,
		'title' => $title,
		'created_by' => $_SESSION['auth'],
	]);

	return empty($stmt->errorInfo()[1]) ? pdo()->lastInsertId() : false;
}