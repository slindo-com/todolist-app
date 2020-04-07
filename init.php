<?php

require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";



function e($str) {
	return htmlentities($str, ENT_QUOTES, 'UTF-8');
}



try {
	$GLOBALS['pdo'] = new PDO(
		config()['databaseConnection'],
		config()['databaseUser'],
		config()['databasePassword']
	);
} catch (PDOException $e) {
	echo "Verbindung zur Datenbank fehlgeschlagen";
	die();
}
$GLOBALS['pdo']->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);



function pdo() {
	return $GLOBALS['pdo'];
}



function pdoFindByAttribute($config, $attr, $val) {
	$stmt = pdo()->prepare('SELECT * FROM '.$config['table'].' WHERE '.$attr.' = :value');
	$stmt->execute(['value' => $val]);
	$stmt->setFetchMode(PDO::FETCH_CLASS, $config['asset']);
	return $stmt->fetch(PDO::FETCH_CLASS);
}



function pdoGet($config, $id) {
	return pdoFindByAttribute($config, 'id', $id);
}



function render($view, $params) {
	extract($params);
	include __DIR__ . "/src/Views/{$view}.php";
}



function includeServices($arr) {
	$arrForEach = gettype($arr) == 'string' ? [$arr] : $arr;
	foreach ($arrForEach as $val) {
		include_once __DIR__ .'/src/Services/'. $val .'Service.php'; 
	}
}



function includeModels($arr) {
	$arrForEach = gettype($arr) == 'string' ? [$arr] : $arr;
	foreach ($arrForEach as $val) {
		include_once __DIR__ .'/src/Models/'. $val .'Model.php'; 
	}
}



abstract class AbstractAsset implements ArrayAccess {

	public function offsetExists($offset) {
		return isset($this->$offset);
	}

	public function offsetGet($offset) {
		return $this->$offset;
	}

	public function offsetSet($offset, $value) {
		$this->$offset = $value;
	}

	public function offsetUnset($offset) {
		unset($this->$offset);
	}
}


