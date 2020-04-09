<?php

function M_UNSUBSCRIBED_EMAILS() {
	return [ 
		'table' => 'unsubscribed_emails', 
		'asset' => 'UnsubscribedEmailsAsset'
	];
}

class UnsubscribedEmailsAsset extends AbstractAsset {
	public $id;
	public $encrypted_email;
	public $created_at;
}



function unsubscribedEmailsModelNew($encrypted_email) {

	$stmt = pdo()->prepare('INSERT INTO unsubscribed_emails (encrypted_email) VALUES (:encrypted_email)');
	$stmt->execute([ 'encrypted_email' => $encrypted_email ]);

	return empty($stmt->errorInfo()[1]);
}

