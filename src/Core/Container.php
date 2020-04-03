<?php

namespace App\Core;

use PDO;
use Exception;
use PDOException;

/*use App\Post\PostsRepository;
use App\Post\CommentsRepository;
use App\Post\PostsController;
use App\Post\PostsAdminController;
*/
use App\Auth\UsersRepository;
use App\Auth\PasswordResetsRepository;

use App\Common\CommonController;
use App\Common\MailService;

use App\Auth\AuthController;
use App\Auth\AuthService;

use App\Settings\SettingsController;
use App\Lists\ListsController;

class Container {

  private $receipts = [];
  private $instances = [];

  public function __construct() {
    $this->receipts = [
      'commonController' => function() {
        return new CommonController();
      },
      'mailService' => function() {
        return new MailService();
      },
      'authService' => function() {
        return new AuthService(
          $this->make("usersRepository"),
          $this->make("passwordResetsRepository")
        );
      },
      'authController' => function() {
        return new AuthController(
          $this->make("authService"),
          $this->make("mailService")
        );
      },
      'listsController' => function() {
        return new ListsController();
      },
      'settingsController' => function() {
        return new settingsController();
      },
      'usersRepository' => function() {
        return new UsersRepository(
          $this->make("pdo")
        );
      },
      'passwordResetsRepository' => function() {
        return new PasswordResetsRepository(
          $this->make("pdo")
        );
      },
      'pdo' => function() {
        try {
          $pdo = new PDO(
            config()['databaseConnection'],
            config()['databaseUser'],
            config()['databasePassword']
          );
        } catch (PDOException $e) {
          echo "Verbindung zur Datenbank fehlgeschlagen";
          die();
        }
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
      }
    ];
  }

  public function make($name) {
    if (!empty($this->instances[$name])) {
      return $this->instances[$name];
    }

    if (isset($this->receipts[$name])) {
      $this->instances[$name] = $this->receipts[$name]();
    }

    return $this->instances[$name];
  }
}
?>