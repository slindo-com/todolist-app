<?php // ROUTE: /settings/general/trashed-lists/

F::verifyAuth();
$user = F::dbGet(M::USERS(), $_SESSION['auth']);

$teams = F::teamsModelGetTeams($_SESSION['auth']);

$teamsById = [];
foreach ($teams as $team) {
	$teamsById[$team->id] = $team;
}

if (F::actionEquals('reactivate')) {
	if (F::listsModelHasRights($_POST['listId'])) {
		F::dbUpdate(M::LISTS(), $_POST['listId'], ['trashed' => 0]);
		$listWasReactivated = true;
	}

} else if (F::actionEquals('delete')) {
	if (F::listsModelHasRights($_POST['listId'])) {

		$tasks = F::dbFindAll(M::TASKS(), ['list' => $_POST['listId']]);
		foreach ($tasks as $task) {
			F::dbDelete(M::TASKS(), $task->id);
		}

		F::dbDelete(M::LISTS(), $_POST['listId']);
		$listWasDeleted = true;
	}
}

$trashedLists = F::listsModelGetTrashed($teams);

$trashedListCount = 0;
foreach ($trashedLists as $trashedListTeam) {
	$trashedListCount += sizeof($trashedListTeam);
}

if ($trashedListCount == 0) {
	header('Location: /settings/');
	die();
}

F::render('settings/trashed-lists', [
	'user' => $user,
	'teams' => $teamsById,
	'trashedLists' => $trashedLists,
	'listWasReactivated' => !empty($listWasReactivated),
	'listWasDeleted' => !empty($listWasDeleted),
]);