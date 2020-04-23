<?php

function teamsModelUpdateTitle($teamId, $title) {
	$baseSlug = F::createSlug($title);
	$slug = $baseSlug;
	$count = 1;

	while (!empty(F::dbFindOne(M::TEAMS(), ['slug' => $slug]))) {
		$slug = $baseSlug . '-' . $count;
		$count++;
	}

	F::dbUpdate(M::TEAMS(), $teamId, [
		'title' => $title,
		'slug' => $slug,
	]);

	return true;
}