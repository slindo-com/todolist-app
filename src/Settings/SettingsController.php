<?php

namespace App\Settings;

use App\Core\AbstractController;

class SettingsController extends AbstractController {

  public function __construct() {

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
