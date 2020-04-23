<?php
function listsModelGetUserLists($userId) {
	$stmt = pdo()->prepare('SELECT * FROM lists WHERE created_by = :created_by AND team = 0 AND trashed = 0 ORDER BY title');
	$stmt->execute(['created_by' => $userId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M::LISTS()['asset']);
}