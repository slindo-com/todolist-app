<?php

//
function INVITE($title, $url, $token) {
	return [
		'subject' => 'Invite to ' . $title . '',
		'message' => 'Go here: ' . $url . '/new-account/' . $token . '/',
	];
}
