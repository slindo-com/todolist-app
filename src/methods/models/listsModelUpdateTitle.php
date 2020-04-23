<?php

function listsModelUpdateTitle($teamId, $listId, $title) {
	$baseSlug = F::createSlug($title);
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

	F::dbUpdate(M::LISTS(), $listId, [
		'title' => $title,
		'slug' => $slug,
	]);

	return $slug;
}