<?php

function getNav($teamSlug, $listSlug) {

	$teams = F::teamsModelGetTeams($_SESSION['auth']);

	if ($teamSlug == 'private') {
		$lists = F::listsModelGetUserLists($_SESSION['auth']);
	} else {
		foreach ($teams as $teamToControl) {
			if ($teamToControl->slug == $teamSlug) {
				$team = $teamToControl;
				break;
			}
		}

		$lists = F::dbFindAll(M::LISTS(), ['team' => $team->id], 'title');
	}

	$navData = [
		'teamSlug' => $teamSlug,
		'teams' => $teams,
		'team' => !empty($team) ? $team : NULL,
		'lists' => !empty($lists) ? $lists : [],
	];

	if (!empty($listSlug)) {
		$list = F::dbFindOne(M::LISTS(), ['slug' => $listSlug]);
		$navData['listSlug'] = $listSlug;
		$navData['list'] = $list;
	}

	return $navData;
}