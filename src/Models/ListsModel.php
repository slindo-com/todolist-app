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
function listsModelNew($teamId) {
	$baseSlug = 'new-list';
	$slug = $baseSlug;
	$count = 1;

	while (empty($teamId) ? !listsModelSlugValid($slug, $teamId) : !listsModelSlugValidPrivate($slug)) {
		$slug = $baseSlug . '-' . $count;
		$count++;
	}

	$stmt = pdo()->prepare("INSERT INTO lists (title, slug, team, created_by) VALUES (:title, :slug, :team, :created_by)");
	$stmt->execute([
		'title' => 'New List',
		'slug' => $slug,
		'team' => !empty($teamId) ? $teamId : 0,
		'created_by' => $_SESSION['auth'],
	]);

	return $slug;
}

//
function listsModelSlugValid($slug, $teamId) {
	$stmt = pdo()->prepare('SELECT id FROM lists WHERE slug = :slug AND team = :team');
	$stmt->execute([
		'slug' => $slug,
		'team' => $teamId,
	]);
	$stmt->setFetchMode(PDO::FETCH_CLASS, M_LISTS()['asset']);
	$hasSlug = $stmt->fetch(PDO::FETCH_CLASS);
	return $hasSlug ? false : true;
}

//
function listsModelSlugValidPrivate($slug) {
	$stmt = pdo()->prepare('SELECT id FROM lists WHERE slug = :slug AND created_by = :created_by');
	$stmt->execute([
		'slug' => $slug,
		'created_by' => $_SESSION['auth'],
	]);
	$stmt->setFetchMode(PDO::FETCH_CLASS, M_LISTS()['asset']);
	$hasSlug = $stmt->fetch(PDO::FETCH_CLASS);
	return $hasSlug ? false : true;
}

//
function listsModelUpdateTitle($teamId, $listId, $title) {
	$baseSlug = listsModelCreateSlug($title);
	$slug = $baseSlug;
	$count = 1;

	while (empty($teamId) ? !listsModelSlugValid($slug, $teamId) : !listsModelSlugValidPrivate($slug)) {
		$slug = $baseSlug . '-' . $count;
		$count++;
	}

	$stmt = pdo()->prepare('UPDATE lists SET title = :title, slug = :slug WHERE id = :id');
	$stmt->execute([
		'title' => $title,
		'slug' => $slug,
		'id' => $listId,
	]);

	return $slug;
}

//
function listsModelCreateSlug($str) {
	return strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), '-'));
}

//
function listsModelGetUserLists($userId) {
	$stmt = pdo()->prepare('SELECT * FROM lists WHERE created_by = :created_by AND team = 0 AND trashed = 0');
	$stmt->execute(['created_by' => $userId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M_LISTS()['asset']);
}

//
function listsModelChangeTaskCount($listId, $increment) {
	$stmt = pdo()->prepare('UPDATE lists SET task_count = task_count ' . ($increment ? '+' : '-') . ' 1 WHERE id = :id');
	$stmt->execute(['id' => $listId]);
}

//
function listsModelChangeDoneCount($listId, $increment) {
	$stmt = pdo()->prepare('UPDATE lists SET done_count = done_count ' . ($increment ? '+' : '-') . ' 1 WHERE id = :id');
	$stmt->execute(['id' => $listId]);
}