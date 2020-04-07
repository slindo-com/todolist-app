<?php

function M_TEAMS() {
	return [ 
	'table' => 'teams', 
	'asset' => 'TeamsAsset'
	];
}

class TeamsAsset extends AbstractAsset {
	public $id;
	public $title;
	public $slug;
	public $created_by;
	public $created_at;
}



function teamsModelNew($userId) {

	$baseSlug = 'new-team';
	$slug = $baseSlug;
	$count = 1;

	while (!teamsModelIsSlugValid($slug)) {
		$slug = $baseSlug .'-'. $count;
		$count++;
	}

	$stmt = pdo()->prepare("INSERT INTO teams (slug, created_by) VALUES (:slug, :created_by)");

	$stmt2 = pdo()->prepare("INSERT INTO team_members (user, team, role) VALUES (:user, :team, :role)");

	pdo()->beginTransaction();

	$stmt->execute([
		'slug' => $slug,
		'created_by' => $userId
	]);

	$teamId = pdo()->lastInsertId();

	$stmt2->execute([
		'user' => $userId,
		'team' => $teamId,
		'role' => 1
	]);

	if(empty($stmt->errorInfo()[1]) && empty($stmt2->errorInfo()[1])) {
		pdo()->commit();
		return true;
	} else {
		pdo()->rollBack();
		return false;
	}
}



function teamsModelUpdateTitle($teamId, $title) {
	$baseSlug = teamsModelCreateSlug($title);
	$slug = $baseSlug;
	$count = 1;

	while (!teamsModelIsSlugValid($slug)) {
		$slug = $baseSlug .'-'. $count;
		$count++;
	}

	$stmt = pdo()->prepare('UPDATE teams SET title = :title, slug = :slug WHERE id = :id');
	$stmt->execute([
		'title' => $title,
		'slug' => $slug,
		'id' => $teamId
	]);

	return true;
}



function teamsModelIsSlugValid($slug) {
	$hasSlug = pdoFindByAttribute(M_TEAMS(), 'slug', $slug);
	return $hasSlug ? false : true;
}



function teamsModelCreateSlug($str) {
	return strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), '-'));
} 
	

function teamsModelGetTeams($userId) {

	$stmt = pdo()->prepare(
		"SELECT * FROM team_members LEFT JOIN teams ON teams.id = team_members.team WHERE team_members.user = :userId"
	);
	$stmt->execute(['userId' => $userId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M_TEAMS()['asset']);
}


function teamsModelGetMemberCount($teamId) {
	$stmt = pdo()->prepare('SELECT COUNT(*) as count FROM team_members WHERE team = :team');
	$stmt->execute(['team' => $teamId]);
	$count = $stmt->fetch();

	return $count['count'];
}
