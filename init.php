<?php

require __DIR__ . "/autoload.php";

function e($str)
{
  return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

$container = new App\Core\Container();


 ?>
