<?php

namespace App\Settings;

use App\Core\AbstractController;
use App\Auth\AuthService;

class SettingsController extends AbstractController {

  public function __construct(AuthService $authService) {
    $this->authService = $authService;
  }

  public function index() {
    $this->render("settings/index", []);
  }

  public function teams() {
    $this->render("settings/teams", []);
  }

  public function newTeam() {
    echo 'TODO: SETTINGS: NEW TEAM';
  }

  public function team() {
    echo 'TODO: SETTINGS: TEAM';
  }

  public function newMember() {
    echo 'TODO: SETTINGS: NEW MEMBER';
  }

  public function account() {
    $this->authService->verifyAuth();
    
    if(!empty($_POST['a']) && $_POST['a'] == 'sign-out') {
      $this->authService->signOut();
    }
    $this->render("settings/account", []);
  }

  public function changeEmail() {
    echo 'TODO: SETTINGS: CHANGE EMAIL';
  }

  public function changePassword() {
    echo 'TODO: SETTINGS: CHANGE PASSWORD';
  }
}

 ?>
