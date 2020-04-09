<?php

function CONFIG() {	
	return [
		'title' => 'Todolist One',
		'url' => 'https://todolist.one',


		'databaseConnection' => 'mysql:host=localhost;dbname=todolist_one;charset=utf8',
		'databaseUser' => 'root',
		'databasePassword' => 'root',

		'emailSender' => 'Ben@Todolist.One'
	];
}
