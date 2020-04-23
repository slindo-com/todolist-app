<?php

function listsModelChangeDoneCount($listId, $increment) {
	$stmt = pdo()->prepare('UPDATE lists SET done_count = done_count ' . ($increment ? '+' : '-') . ' 1 WHERE id = :id');
	$stmt->execute(['id' => $listId]);
}