<?php

includeModels(['Teams', 'Lists']);

//
function listsServiceGetNav($teamSlug, $listSlug) {

	$teams = teamsModelGetTeams($_SESSION['auth']);

	if ($teamSlug == 'private') {
		$lists = listsModelGetUserLists($_SESSION['auth']);
	} else {
		// pdoFindByAttribute(M_TEAMS(),)
		foreach ($teams as $teamToControl) {
			if ($teamToControl->slug == $teamSlug) {
				$team = $teamToControl;
				break;
			}
		}
	}

	$navData = [
		'teamSlug' => $teamSlug,
		'teams' => $teams,
		'team' => !empty($team) ? $team : NULL,
		'lists' => !empty($lists) ? $lists : [],
	];

	if (!empty($listSlug)) {
		$list = pdoFindByAttribute(M_LISTS(), 'slug', $listSlug);
		$navData['listSlug'] = $listSlug;
		$navData['list'] = $list;
	}

	return $navData;
}
