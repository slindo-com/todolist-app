<?php

function sendCacheHeaders() {
	$min = 1440;
	$expires = date('M d Y H:i:s', mktime(0, 0, 0, 1, 1, 2040));
	$modified = date('M d Y H:i:s', mktime(0, 0, 0, 1, 1, 2010));

	header('Expires: ' . $expires);
	header('Last-Modified: ' . $modified);
	header('Cache-Control: public, max-age=' . $min * 60);
	header('Pragma: max-age=' . $min * 60);
}