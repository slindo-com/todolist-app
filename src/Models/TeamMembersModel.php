<?php

//
function M_TEAM_MEMBERS() {
	return [
		'table' => 'team_members',
		'asset' => 'TeamMembersAsset',
	];
}

//
class TeamMembersAsset extends AbstractAsset {
	public $user;
	public $team;
	public $role;
}

//
function teamMembersModelNew($userId, $teamId) {
	$stmt = pdo()->prepare("INSERT INTO team_members (user, team, role) VALUES (:user, :team, :role)");
	$stmt->execute([
		'user' => $userId,
		'team' => $teamId,
		'role' => 2,
	]);
	return empty($stmt->errorInfo()[1]);
}
