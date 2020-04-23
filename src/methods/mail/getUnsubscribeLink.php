<?php
function getUnsubscribeLink($encryptedEmail) {

	$link = 'If you do not want to receice emails from this address, please unsubscribe here: ' . CONFIG()['url'] . '/unsubscribe/' . $encryptedEmail . '/';

	return $link;
}