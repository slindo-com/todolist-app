<?php

includeModels(['Teams', 'Lists']);


function listsServiceGetNav($teamSlug, $listSlug) {

	if($teamSlug == 'private') {
		$lists = listsModelGetUserLists($_SESSION['auth']);
	} else {
		// pdoFindByAttribute(M_TEAMS(),)
	}

	$navData = [
		'teamSlug' => $teamSlug,
		'lists' => $lists
	];

	if(!empty($listSlug)) {
		$list = pdoFindByAttribute(M_LISTS(), 'slug', $listSlug);
		$navData['listSlug'] = $listSlug;
		$navData['list'] = $list;
	}

	return $navData;
}


