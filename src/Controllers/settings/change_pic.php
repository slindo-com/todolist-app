<?php // ROUTE: /settings/account/change-pic/

F::verifyAuth();

$user = F::dbGet(M::USERS(), $_SESSION['auth']);

if (F::actionEquals('change-picture')) {

	$picName = bin2hex(random_bytes(10));
	$picNameParts = explode('.', $_FILES['pic']['name']);
	$picType = end($picNameParts);
	$uploadfile = __DIR__ . '/../../public/pics/' . $picName . '.' . $picType;

	move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile);

	F::dbUpdate(M::USERS(), $user->id, ['pic' => $picName . '.' . $picType]);

	header('Location: /settings/account/?success=change-pic');
}

F::render('settings/account-change-pic', [
	'user' => $user,
	'error' => !empty($error) ? $error : false,
]);
