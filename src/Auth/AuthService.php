<?php

namespace App\Auth;

class AuthService {
  public function __construct(UsersRepository $usersRepository) {
    $this->usersRepository = $usersRepository;
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
    $user = $this->usersRepository->findByEmail($email);
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

    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    $lowerCaseEmail = strtolower($email);

    $lastId = $this->usersRepository->new($lowerCaseEmail, $encryptedPassword);

    if ($lastId != 0) {
      $_SESSION['auth'] = $lastId;
      session_regenerate_id(true);
      return true;
    } else {
      return false;
    }
  }

  public function logout() {
    unset($_SESSION['auth']);
    session_regenerate_id(true);
  }
}
?>