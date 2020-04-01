<?php

namespace App\Auth;

use App\Core\AbstractModel;

class UserModel extends AbstractModel {
  public $id;
  public $email;
  public $password;
  public $name;
  public $avatar;
  public $email_verified;
  public $created_at;
}
?>