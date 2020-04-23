<?php

function teamsModelNew($userId) {

	$baseSlug = 'new-team';
	$slug = $baseSlug;
	$count = 1;

	while (!empty(F::dbFindOne(M::TEAMS(), ['slug' => $slug]))) {
		$slug = $baseSlug . '-' . $count;
		$count++;
	}

	$stmt = pdo()->prepare("INSERT INTO teams (slug, created_by) VALUES (:slug, :created_by)");

	$stmt2 = pdo()->prepare("INSERT INTO team_members (user, team, role) VALUES (:user, :team, :role)");

	pdo()->beginTransaction();

	$stmt->execute([
		'slug' => $slug,
		'created_by' => $userId,
	]);

	$teamId = pdo()->lastInsertId();

	$stmt2->execute([
		'user' => $userId,
		'team' => $teamId,
		'role' => 1,
	]);

	if (empty($stmt->errorInfo()[1]) && empty($stmt2->errorInfo()[1])) {
		pdo()->commit();
		return true;
	} else {
		pdo()->rollBack();
		return false;
	}
}