<?php // ROUTE: /settings/account/

F::verifyAuth();

$user = F::dbGet(M::USERS(), $_SESSION['auth']);

if (F::actionEquals('sign-out')) {
	F::signOut();
} else if (F::actionEquals('save-name')) {
	$updateNameSuccess = F::dbUpdate(M::USERS(), $user->id, ['name' => $_POST['name']]);
	$user->name = $_POST['name'];

	if ($updateNameSuccess) {
		$query['success'] = 'change-name';
	}
}

F::render('settings/account', [
	'user' => $user,
	'success' => !empty($query['success']) ? $query['success'] : false,
]);
