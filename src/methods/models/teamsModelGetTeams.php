<?php
function teamsModelGetTeams($userId) {

	$stmt = pdo()->prepare(
		"SELECT * FROM team_members LEFT JOIN teams ON teams.id = team_members.team WHERE team_members.user = :userId"
	);
	$stmt->execute(['userId' => $userId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M::TEAMS()['asset']);
}