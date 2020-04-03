<?php

namespace App\Auth;

use App\Core\AbstractModel;

class PasswordResetsModel extends AbstractModel {
  public $token;
  public $email;
  public $created_by;
  public $created_at;
}
?>