<?php

function M_INVITES() {
	return [ 
		'table' => 'invites', 
		'asset' => 'InvitesAsset'
	];
}

class InvitesAsset extends AbstractAsset {
	public $token;
	public $team;
	public $email;
	public $name;
	public $created_by;
	public $created_at;
}



function invitesModelNew($teamId, $email, $name, $token) {

	$stmt = pdo()->prepare('INSERT INTO invites (token, team, email, name, created_by) VALUES (:token, :team, :email, :name, :created_by)');
	$stmt->execute([
		'token' => $token,
		'team' => $teamId,
		'email' => $email,
		'name' => $name,
		'created_by' => $_SESSION['auth']
	]);

	return empty($stmt->errorInfo()[1]);
}



function invitesModelGetTeamInvites($teamId) {
	$stmt = pdo()->prepare('SELECT * FROM invites WHERE team = :teamId');
	$stmt->execute(['teamId' => $teamId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, M_INVITES()['asset']);
}


