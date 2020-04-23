<?php

function teamsModelGetMemberCount($teamId) {
	$stmt = pdo()->prepare('SELECT COUNT(*) as count FROM team_members WHERE team = :team');
	$stmt->execute(['team' => $teamId]);
	$count = $stmt->fetch();

	return $count['count'];
}