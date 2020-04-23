<?php

function usersModelGetTeamMembers($teamId) {
	$stmt = pdo()->prepare("SELECT * FROM users LEFT JOIN team_members ON users.id = team_members.user WHERE team_members.team = :teamId");
	$stmt->execute(['teamId' => $teamId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M::USERS()['asset']);
}