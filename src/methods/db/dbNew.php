<?php

function dbNew($config, $attributes) {

	$valuesArr1 = [];
	$valuesArr2 = [];
	foreach ($attributes as $key => $val) {
		array_push($valuesArr1, $key);
		array_push($valuesArr2, ':' . $key);
	}
	$values1 = implode(', ', $valuesArr1);
	$values2 = implode(', ', $valuesArr2);

	$stmt = pdo()->prepare('INSERT INTO ' . $config['table'] . ' (' . $values1 . ') VALUES (' . $values2 . ')');

	$stmt->execute($attributes);

	$error = $stmt->errorInfo();

	if ($error[1] == 1062) {
		throw new Exception('DUPLICATE');
		return false;
	} else if (!empty($error[1])) {
		throw new Exception($error[1]);
		return false;
	}

	return pdo()->lastInsertId();
}