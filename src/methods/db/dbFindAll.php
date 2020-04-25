<?php

function dbFindAll($config, $attributes, $order = false) {
	$whereStatementArr = [];
	foreach ($attributes as $key => $val) {
		array_push($whereStatementArr, $key . ' = :' . $key);
	}
	$whereStatement = implode(' AND ', $whereStatementArr);

	$orderStatement = !empty($order) ? (' ORDER BY ' . $order) : '';

	$stmt = pdo()->prepare('SELECT * FROM ' . $config['table'] . ' WHERE ' . $whereStatement . $orderStatement);
	$stmt->execute($attributes);
	return $stmt->fetchAll(PDO::FETCH_CLASS, $config['asset']);
}