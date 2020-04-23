<?php
function encryptEmail($email) {
	$cipher = 'AES-128-CTR';
	$iv_length = openssl_cipher_iv_length($cipher);
	$options = 0;
	$iv = '8565825542115032';
	$enc_key = CONFIG()['encryptionKey'];

	$encrypted = base64_encode(openssl_encrypt(strtolower($email), $cipher, $enc_key, $options, $iv));

	return str_replace('=', '', $encrypted);
}