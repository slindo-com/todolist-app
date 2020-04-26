<?php

function listsModelGetTrashed($teams = false) {

	$teams = !empty($teams) ? $teams : F::teamsModelGetTeams($_SESSION['auth']);

	$trashedLists = [];
	$trashedLists[0] = F::dbFindAll(M::LISTS(), [
		'team' => 0,
		'trashed' => 1,
		'created_by' => $_SESSION['auth'],
	], 'title');

	foreach ($teams as $team) {
		$trashedLists[$team->id] = F::dbFindAll(M::LISTS(), [
			'team' => $team->id,
			'trashed' => 1,
		], 'title');
	}

	return $trashedLists;
}