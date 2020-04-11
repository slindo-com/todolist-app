<?php

//
function EMAIL_NEW_ACCOUNT($title) {
	return [
		'subject' => 'Welcome to ' . $title . '',
		'message' => 'Welcome to ' . $title . ',',
	];
}
