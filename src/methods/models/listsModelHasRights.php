<?php

function listsModelHasRights($listId, $teams = false) {
	$teams = !empty($teams) ? $teams : F::teamsModelGetTeams($_SESSION['auth']);
	$list = F::dbGet(M::LISTS(), $listId);

	$isInTeams = false;
	foreach ($teams as $teamToControl) {
		if ($teamToControl->id == $list->team) {
			$isInTeams = true;
		}
	}

	$isPrivateList = $list->team == 0 && $list->created_by == $_SESSION['auth'];

	return ($isPrivateList OR $isInTeams);
}