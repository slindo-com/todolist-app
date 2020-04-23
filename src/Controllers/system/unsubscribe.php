<?php // ROUTE: /unsubscribe/:token/

$encryptedEmail = $attributes[0];

if (F::actionEquals('unsubscribe')) {
	$unsubscribed = F::dbNew(M::UNSUBSCRIBED_EMAILS(), ['encrypted_email' => $encryptedEmail]);
}

F::render('system/unsubscribe', [
	'unsubscribed' => !empty($unsubscribed) ? true : false,
]);
