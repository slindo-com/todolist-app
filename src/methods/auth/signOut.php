<?php
function signOut() {
	unset($_SESSION['auth']);
	session_regenerate_id(true);
	header('Location: /sign-in/');
	die();
}