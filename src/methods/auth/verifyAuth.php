<?php
function verifyAuth() {
	if (isset($_SESSION['auth'])) {
		return true;
	} else {
		header('Location: /sign-in/');
		die();
	}
}