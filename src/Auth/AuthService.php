<?php

namespace App\Auth;

class AuthService {
  public function __construct(UsersRepository $usersRepository, PasswordResetsRepository $passwordResetsRepository) {
    $this->usersRepository = $usersRepository;
    $this->passwordResetsRepository = $passwordResetsRepository;
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

    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
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

  public function setPassword($password) {
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
    $response = $this->usersRepository->setPassword($_SESSION['auth'], $encryptedPassword);
    return $response;
  }

  public function newResetToken($email) {
    $token = bin2hex(random_bytes(50));
    $success = $this->passwordResetsRepository->new($token, $email, $_SESSION['auth']);

    if($success) {
      return $token;
    } else {
      return false;
    }
  }

  public function getResetToken($token) {
    $databaseToken = $this->passwordResetsRepository->getToken($token);
    return $databaseToken;
  }


  public function logout() {
    unset($_SESSION['auth']);
    session_regenerate_id(true);
  }
}
?>