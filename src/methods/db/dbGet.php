<?php

function dbGet($config, $id) {
	$stmt = pdo()->prepare('SELECT * FROM ' . $config['table'] . ' WHERE id = :id');
	$stmt->execute(['id' => $id]);
	$stmt->setFetchMode(PDO::FETCH_CLASS, $config['asset']);
	return $stmt->fetch(PDO::FETCH_CLASS);
}