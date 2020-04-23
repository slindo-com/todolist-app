<?php

function dbFindAll($config, $attributes) {
	$whereStatementArr = [];
	foreach ($attributes as $key => $val) {
		array_push($whereStatementArr, $key . ' = :' . $key);
	}
	$whereStatement = implode(' AND ', $whereStatementArr);
	$stmt = pdo()->prepare('SELECT * FROM ' . $config['table'] . ' WHERE ' . $whereStatement);
	$stmt->execute($attributes);
	return $stmt->fetchAll(PDO::FETCH_CLASS, $config['asset']);
}