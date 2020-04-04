<?php

namespace App\Auth;

use App\Models\UsersModel;
use App\Models\PasswordResetsModel;

class AuthService {


	public function __construct(UsersModel $usersModel, PasswordResetsModel $passwordResetsModel) {
		$this->usersModel = $usersModel;
		$this->passwordResetsModel = $passwordResetsModel;
	}


	public function hasAuth() {
		if (isset($_SESSION['auth'])) {
			return true;
		} else {
			header("Location: /sign-in/");
			die();
		}
	}


	public function auth($email, $password) {
		$user = $this->usersModel->findByAttribute('email', $email);
		if (empty($user)) {
			return false;
		}

		if (password_verify($password, $user->password)) {
			$_SESSION['auth'] = $user->id;
			session_regenerate_id(true);
			return true;
		} else {
			return false;
		}
	}


	public function newAccount($email, $password) {

		$encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
		$lowerCaseEmail = strtolower($email);

		$lastId = $this->usersModel->new($lowerCaseEmail, $encryptedPassword);

		if ($lastId != 0) {
			$_SESSION['auth'] = $lastId;
			session_regenerate_id(true);
			return true;
		} else {
			return false;
		}
	}


	// TODO: Refactor completely to model
	public function setPassword($password) {
		return $this->usersModel->setPassword($password);
	}


	public function newResetToken($email) {
		$token = bin2hex(random_bytes(50));
		$success = $this->passwordResetsModel->new($token, $email, $_SESSION['auth']);

		if($success) {
			return $token;
		} else {
			return false;
		}
	}

	// TODO: Refactor completely to model
	public function getResetToken($token) {
		return $this->passwordResetsModel->findByAttribute('token', $token);
	}


	public function logout() {
		unset($_SESSION['auth']);
		session_regenerate_id(true);
	}
}
?>