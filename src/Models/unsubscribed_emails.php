<?php

//
function UNSUBSCRIBED_EMAILS() {
	return [
		'table' => 'unsubscribed_emails',
		'asset' => 'UnsubscribedEmailsAsset',
	];
}

//
class UnsubscribedEmailsAsset extends AbstractAsset {
	public $id;
	public $encrypted_email;
	public $created_at;
}