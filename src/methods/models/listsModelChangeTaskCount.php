<?php

function listsModelChangeTaskCount($listId, $increment) {
	$stmt = pdo()->prepare('UPDATE lists SET task_count = task_count ' . ($increment ? '+' : '-') . ' 1 WHERE id = :id');
	$stmt->execute(['id' => $listId]);
}