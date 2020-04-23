<?php // ROUTE: /settings/account/change-password/

F::verifyAuth();

$user = F::dbGet(M::USERS(), $_SESSION['auth']);

if (F::actionEquals('change-password')) {
	if (password_verify($_POST['old-password'], $user->password)) {
		$encryptedPassword = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
		F::dbUpdate(M::USERS(), $user->id, ['password' => $encryptedPassword]);
		header('Location: /settings/account/?success=change-password');
	} else {
		$error = 'Your old password was wrong. Please try again.';
	}
}

F::render('settings/account-change-password', [
	'user' => $user,
	'error' => !empty($error) ? $error : false,
]);
