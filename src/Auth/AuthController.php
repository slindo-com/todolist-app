<?php

namespace App\Auth;

use App\Core\AbstractController;

class AuthController extends AbstractController {

  public function __construct(AuthService $authService) {
    $this->authService = $authService;
  }

  public function signIn() {
    $error = false;
    if (!empty($_POST['email']) AND !empty($_POST['password'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      if ($this->authService->auth($email, $password)) {
        header("Location: /own/");
        return;
      } else {
        $error = true;
      }
    }

    $this->render("user/login", [
      'error' => $error
    ]);
  }

  public function logout() {
    $this->authService->logout();
    header("Location: /sign-in/");
  }

  public function newAccount($attributes) {
    echo 'TODO: NEW ACCOUNT';
  }

  public function newPassword($attributes) {
    // $this->authService->check();
    echo 'TODO: NEW PASSWORD';
  }
}
?>