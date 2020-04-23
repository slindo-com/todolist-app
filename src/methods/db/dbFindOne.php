<?php

function dbFindOne($config, $attributes) {
	$whereStatementArr = [];
	foreach ($attributes as $key => $val) {
		array_push($whereStatementArr, $key . ' = :' . $key);
	}
	$whereStatement = implode(' AND ', $whereStatementArr);
	$stmt = pdo()->prepare('SELECT * FROM ' . $config['table'] . ' WHERE ' . $whereStatement);
	$stmt->execute($attributes);
	$stmt->setFetchMode(PDO::FETCH_CLASS, $config['asset']);
	return $stmt->fetch(PDO::FETCH_CLASS);
}