<?php

//
try {
	$GLOBALS['pdo'] = new PDO(
		CONFIG()['databaseConnection'],
		CONFIG()['databaseUser'],
		CONFIG()['databasePassword']
	);
} catch (PDOException $e) {
	echo 'Verbindung zur Datenbank fehlgeschlagen';
	die();
}
$GLOBALS['pdo']->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//
function e($str) {
	echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

//
function pdo() {
	return $GLOBALS['pdo'];
}

//
function i18n($key) {
	echo !empty($GLOBALS['translations'][$key]) ? $GLOBALS['translations'][$key] : 'Property: ' . $key;
}