<?php

includeModels('Users');
includeServices(['Mail', 'Auth']);
includeMails(['new-account', 'new-password']);


function authControllerSignIn() {

	$error = false;

	if (!empty($_POST['email']) AND !empty($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (authServiceAuth($email, $password)) {
			header("Location: /own/");
			return;
		} else {
			$error = true;
		}
	}

	render("auth/sign-in", [
		'error' => $error
	]);
}


function authControllerNewAccount($attributes) {

	$error = false;

	if (!empty($_POST['email']) AND !empty($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (authServiceNewAccount($email, $password)) {

			$emailTemplate = EMAIL_NEW_ACCOUNT(CONFIG()['title']);

			mailServiceSend([
				'to' => $email,
				'subject' => $emailTemplate['subject'],
				'message' => $emailTemplate['message']
			]);

			header("Location: /own/");
			return;
		} else {
			$error = true;
		}
	}

	render("auth/new-account", [
		'error' => $error
	]);
}


function authControllerNewPassword($attributes) {

	$error = false;
	$action = 'DEFAULT';

	if (!empty($_POST['a']) && $_POST['a'] == 'send-instructions') {
		$email = $_POST['email'];

		$token = authServiceNewResetToken($email);

		if(!empty($token)) {

			$emailTemplate = EMAIL_NEW_PASSWORD(CONFIG()['url'], $token);

			mailServiceSend([
				'to' => $email,
				'subject' => $emailTemplate['subject'],
				'message' => $emailTemplate['message']
			]);
			$action = 'TOKEN_SENT';
		} else {
			$error = true;
		}
	}

	if( !empty($attributes[0])) {
		$token = $attributes[0];
		$databaseToken = authServiceGetResetToken($token);

		if (!empty($_POST['a']) && $_POST['a'] == 'set-password') {
			if(!empty($databaseToken)) {
				$usersModelSetPassword($_POST['password']);
				$action = 'PASSWORD_SET';
			} else {
				$action = 'TOKEN_NOT_VALID';
			}
		} else {

			if(!empty($databaseToken)) {
				$action = 'PASSWORD_FORM';
			} else {
				$action = 'TOKEN_NOT_VALID';
			}
		}
	}

	render("auth/new-password", [
		'action' => $action,
		'error' => $error
	]);
}


