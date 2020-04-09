<?php

includeModels('UnsubscribedEmails');


function mailServiceGetUnsubscribeLink($email) {

	$link = 'If you do not want to receice emails from this address, please unsubscribe here: '. CONFIG()['url'] .'/unsubscribe/'. $encryptedEmail;

	return $link;
}


function mailServiceEncrypt($email) {
	$cipher = 'AES-128-CTR'; 
	$iv_length = openssl_cipher_iv_length($cipher); 
	$options = 0;  
	$iv = '8565825542115032';
	$enc_key = CONFIG()['encryptionKey'];

	$encrypted = base64_encode(openssl_encrypt(strtolower($email), $cipher, $enc_key, $options, $iv));
	
	return str_replace('=', '', $encrypted);
}



function mailServiceSend($attributes) {

	$encryptedEmail = mailServiceEncrypt($attributes['to']);

	$isBlocked = pdoFindByAttribute(M_UNSUBSCRIBED_EMAILS, 'encrypted_email', $encryptedEmail);

	if(!empty($isBlocked)) {
		return false;
	}

	$headers = 'From: '. CONFIG()['emailSender'] . "\r\n" .
		'Reply-To:'. CONFIG()['emailSender'] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	$attributes['message'] = $attributes['message'] . "\r\n" . mailServiceGetUnsubscribeLink($encryptedEmail);

	mail(
		$attributes['to'],
		$attributes['subject'],
		$attributes['message'],
		$headers
	);

	return true;
}