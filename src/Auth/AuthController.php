<?php

namespace App\Auth;

use App\Core\AbstractController;
use App\Common\MailService;

class AuthController extends AbstractController {

  public function __construct(AuthService $authService, MailService $mailService) {
    $this->authService = $authService;
    $this->mailService = $mailService;
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

    $this->render("auth/sign-in", [
      'error' => $error
    ]);
  }

  public function logout() {
    $this->authService->logout();
    header("Location: /sign-in/");
  }

  public function newAccount($attributes) {

    $error = false;

    if (!empty($_POST['email']) AND !empty($_POST['password'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      if ($this->authService->newAccount($email, $password)) {

        $this->mailService->send([
          'to' => $email,
          'subject' => 'Welcome to Todolist One',
          'message' => 'Welcome to Todolist One'
        ]);

        header("Location: /own/");
        return;
      } else {
        $error = true;
      }
    }

    $this->render("auth/new-account", [
      'error' => $error
    ]);
  }

  public function newPassword($attributes) {

    $error = false;
    $tokenSent = false;

    if ($_POST['a'] == 'send-instructions') {
      $email = $_POST['email'];

      $token = 'TEST'; // $this->authService->newResetToken($email);

      if(!empty($token)) {
        $this->mailService->send([
          'to' => $email,
          'subject' => 'Reset Instructions',
          'message' => 'Go here: https://app.todolist.one/new-password/' . $token . '/'
        ]);
        $tokenSent = true;
      } else {
        $error = true;
      }
    }

    $this->render("auth/new-password", [
      'tokenSent' => $tokenSent,
      'error' => $error
    ]);
  }
}
?>