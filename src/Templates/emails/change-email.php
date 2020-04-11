<?php

//
function EMAIL_CHANGE_EMAIL($title, $url, $token) {
	return [
		'subject' => 'Please confirm new email address',
		'message' => 'Go here: ' . $url . '/settings/change-email/' . $token . '/',
	];
}
