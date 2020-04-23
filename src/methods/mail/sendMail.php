<?php
function sendMail($attributes) {

	$encryptedEmail = F::encryptedEmail($attributes['to']);

	$isBlocked = F::dbFind(M::UNSUBSCRIBED_EMAILS(), ['encrypted_email' => $encryptedEmail]);

	if (!empty($isBlocked)) {
		return false;
	} else {

		$headers = 'From: ' . CONFIG()['emailSender'] . "\r\n" .
		'Reply-To:' . CONFIG()['emailSender'] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$attributes['message'] = $attributes['message'] . "\r\n" . F::getUnsubscribeLink($encryptedEmail);

		mail(
			$attributes['to'],
			$attributes['subject'],
			$attributes['message'],
			$headers
		);

		return true;
	}
}