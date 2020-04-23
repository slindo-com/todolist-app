<?php

function dbDelete($config, $id) {
	$stmt = pdo()->prepare('DELETE FROM ' . $config['table'] . ' WHERE id = :id');
	$stmt->execute(['id' => $id]);
	return empty($stmt->errorInfo()[1]);
}