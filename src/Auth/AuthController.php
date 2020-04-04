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
    $action = 'DEFAULT';

    if (!empty($_POST['a']) && $_POST['a'] == 'send-instructions') {
      $email = $_POST['email'];

      $token = $this->authService->newResetToken($email);

      if(!empty($token)) {
        $this->mailService->send([
          'to' => $email,
          'subject' => 'Reset Instructions',
          'message' => 'Go here: https://app.todolist.one/new-password/' . $token . '/'
        ]);
        $action = 'TOKEN_SENT';
      } else {
        $error = true;
      }
    }

    if( !empty($attributes[0])) {
      $token = $attributes[0];
      $databaseToken = $this->authService->getResetToken($token);

      if (!empty($_POST['a']) && $_POST['a'] == 'set-password') {
        if(!empty($databaseToken)) {
          $this->authService->setPassword($_POST['password']);
          $action = 'PASSWORD_SET';
        } else {
          $action = 'TOKEN_NOT_VALID';
        }
      } else {

        if(!empty($databaseToken)) {
          $action = 'PASSWORD_FORM';
        } else {
          $action = 'TOKEN_NOT_VALID';
        }
      }
    }

    $this->render("auth/new-password", [
      'action' => $action,
      'error' => $error
    ]);
  }
}
?>