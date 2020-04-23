<?php

function dbUpdate($config, $id, $attributes) {

	$valuesArr = [];
	foreach ($attributes as $key => $val) {
		array_push($valuesArr, $key . ' = :' . $key);
	}
	$values = implode(',', $valuesArr);

	$stmt = pdo()->prepare('UPDATE ' . $config['table'] . ' SET ' . $values . ' WHERE id = :id');

	$attributes['id'] = $id;
	$success = $stmt->execute($attributes);

	return empty($stmt->errorInfo()[1]);
}