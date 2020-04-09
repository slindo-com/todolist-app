<?php

includeModels('UnsubscribedEmails');


function systemControllerUnsubscribe($attributes) {

	$encryptedEmail = $attributes[0];

	if(actionEquals('unsubscribe')) {
		$unsubscribed = unsubscribedEmailsModelNew($encryptedEmail);
	}

	render('system/unsubscribe', [
		'unsubscribed' => !empty($unsubscribed) ? true : false
	]);
}