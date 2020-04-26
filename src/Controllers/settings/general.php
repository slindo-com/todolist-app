<?php // ROUTE: /settings/

F::verifyAuth();
$user = F::dbGet(M::USERS(), $_SESSION['auth']);

if (F::actionEquals('edit-general')) {
	F::dbUpdate(M::USERS(), $user->id, ['language' => $_POST['language']]);
	$user = F::dbGet(M::USERS(), $_SESSION['auth']);

	if ($_SESSION['language'] != $user->language) {
		$_SESSION['language'] = $user->language;
		header('Location: /settings/');
	}
}

$trashedLists = F::listsModelGetTrashed();

$trashedListCount = 0;
foreach ($trashedLists as $key => $trashedListTeam) {
	$trashedListCount += sizeof($trashedListTeam);
}

F::render('settings/general', [
	'user' => $user,
	'trashedListCount' => $trashedListCount,
]);