<?php

function listsModelNew($teamId) {
	$baseSlug = 'new-list';
	$slug = $baseSlug;
	$count = 1;

	if (empty($teamId)) {
		while (F::dbFindOne(M::LISTS(), [
			'slug' => $slug,
			'created_by' => $_SESSION['auth'],
		])) {
			$slug = $baseSlug . '-' . $count;
			$count++;
		}
	} else {
		while (F::dbFindOne(M::LISTS(), [
			'slug' => $slug,
			'team' => $teamId,
		])) {
			$slug = $baseSlug . '-' . $count;
			$count++;
		}
	}

	F::dbNew(M::LISTS(), [
		'title' => 'New List',
		'slug' => $slug,
		'team' => !empty($teamId) ? $teamId : 0,
		'created_by' => $_SESSION['auth'],
	]);

	return $slug;
}