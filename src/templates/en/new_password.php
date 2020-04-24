<?php

//
function NEW_PASSWORD($url, $token) {
	return [
		'subject' => 'Password Reset Instructions',
		'message' => 'Go here: ' . $url . '/new-password/' . $token . '/',
	];
}
