<?php

namespace App\Core;

use PDO;
use Exception;
use PDOException;

use App\Models\InvitesModel;
use App\Models\CommentsModel;
use App\Models\ListsModel;
use App\Models\PasswordResetsModel;
use App\Models\SubTasksModel;
use App\Models\TasksModel;
use App\Models\TeamMembersModel;
use App\Models\TeamsModel;
use App\Models\UsersModel;

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

      'invitesModel' => function() {
        return new InvitesModel($this->make("pdo"));
      },
      'commentsModel' => function() {
        return new CommentsModel($this->make("pdo"));
      },
      'listsModel' => function() {
        return new ListsModel($this->make("pdo"));
      },
      'passwordResetsModel' => function() {
        return new PasswordResetsModel($this->make("pdo"));
      },
      'subTasksModel' => function() {
        return new SubTasksModel($this->make("pdo"));
      },
      'tasksModel' => function() {
        return new TasksModel($this->make("pdo"));
      },
      'teamMembersModel' => function() {
        return new TeamMembersModel($this->make("pdo"));
      },
      'teamsModel' => function() {
        return new TeamsModel($this->make("pdo"));
      },
      'usersModel' => function() {
        return new UsersModel($this->make("pdo"));
      },

      'commonController' => function() {
        return new CommonController();
      },
      'mailService' => function() {
        return new MailService();
      },
      'authService' => function() {
        return new AuthService(
          $this->make("usersModel"),
          $this->make("passwordResetsModel")
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
        return new settingsController(
          $this->make('teamsModel'),
          $this->make('usersModel'),
          $this->make('invitesModel'),
          $this->make('authService'),
          $this->make('mailService')
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