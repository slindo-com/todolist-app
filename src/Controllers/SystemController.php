<?php

includeModels('UnsubscribedEmails');
includeServices('Translations');

translationsGet(!empty($_SESSION['language']) ? $_SESSION['language'] : 'en');

//
function systemControllerUnsubscribe($attributes) {

	$encryptedEmail = $attributes[0];

	if (actionEquals('unsubscribe')) {
		$unsubscribed = unsubscribedEmailsModelNew($encryptedEmail);
	}

	render('system/unsubscribe', [
		'unsubscribed' => !empty($unsubscribed) ? true : false,
	]);
}