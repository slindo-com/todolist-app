<?php

function M_USERS() {
	return [ 
		'table' => 'users', 
		'asset' => 'UsersAsset'
	];
}

class UsersAsset extends AbstractAsset {
	public $id;
	public $email;
	public $password;
	public $name;
	public $avatar;
	public $email_verified;
	public $created_at;
}



function usersModelNew($email, $password) {
	$stmt = pdo()->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
	$success = $stmt->execute([
		'email' => $email,
		'password' => $password
	]);

	return empty($stmt->errorInfo()[1]) ? pdo()->lastInsertId() : false;
}



function usersModelSetPassword($password) {

	$stmt = pdo()->prepare('UPDATE users SET password = :password WHERE id = :id');
	$stmt->execute([
		'id' => $_SESSION['auth'],
		'password' => password_hash($password, PASSWORD_BCRYPT)
	]);
}



function usersModelGetTeamMembers($teamId) {
	$stmt = pdo()->prepare("SELECT * FROM users LEFT JOIN team_members ON users.id = team_members.user WHERE team_members.team = :teamId");
	$stmt->execute(['teamId' => $teamId]);
	return $stmt->fetchAll(PDO::FETCH_CLASS, 'UsersAsset');
}


