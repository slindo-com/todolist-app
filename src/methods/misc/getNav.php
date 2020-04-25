<?php

function getNav($teamSlug, $listSlug) {

	$teams = F::teamsModelGetTeams($_SESSION['auth']);

	if ($teamSlug == 'private') {
		$lists = F::dbFindAll(M::LISTS(), [
			'team' => 0,
			'trashed' => 0,
			'created_by' => $_SESSION['auth'],
		], 'title');

	} else {
		// Find team for teamSlug
		foreach ($teams as $teamToControl) {
			if ($teamToControl->slug == $teamSlug) {
				$team = $teamToControl;
				break;
			}
		}

		if (!empty($team)) {
			$lists = F::dbFindAll(M::LISTS(), ['team' => $team->id], 'title');
		}
	}

	$navData = [
		'teamSlug' => $teamSlug,
		'teams' => $teams,
		'team' => !empty($team) ? $team : NULL,
		'lists' => !empty($lists) ? $lists : [],
	];

	if (!empty($listSlug)) {
		$list = F::dbFindOne(M::LISTS(), ['slug' => $listSlug]);

		if (!empty($list) && $teamSlug == 'private') {
			if ($list->team == 0 && $list->created_by == $_SESSION['auth']) {
				$navData['listSlug'] = $listSlug;
				$navData['list'] = $list;
			}
		}
		if (!empty($list) && $teamSlug != 'private') {
			if (!empty($team) && $list->team == $team->id) {
				$navData['listSlug'] = $listSlug;
				$navData['list'] = $list;
			}

		}
	}

	return $navData;
}