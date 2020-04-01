<?php

namespace App\Lists;

use App\Core\AbstractController;

class ListsController extends AbstractController {

  public function __construct() {

  }

  public function todo() {
    echo 'TODO: LISTS: TODO';
  }

  public function important() {
    echo 'TODO: LISTS: IMPORTANT';
  }

  public function today() {
    echo 'TODO: LISTS: TODAY';
  }

  public function week() {
    echo 'TODO: LISTS: WEEK';
  }

  public function list() {
    echo 'TODO: LISTS: LIST';
  }

  public function all() {
    echo 'TODO: LISTS: ALL';
  }
}

 ?>
