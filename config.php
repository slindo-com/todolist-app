<?php

function config() {	
	$config = [
		'databaseConnection' => 'mysql:host=localhost;dbname=todolist_one;charset=utf8',
		'databaseUser' => 'root',
		'databasePassword' => 'root',

		'emailSender' => 'Ben@Todolist.One'
	];
	return $config;
}
