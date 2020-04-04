<?php

session_start();

require __DIR__ . "/../init.php";

$requestUri = $_SERVER['REQUEST_URI'];

$routes = [
  '/' => [
    'controller' => 'commonController',
    'method' => 'index'
  ],
  
  '/sign-in/' => [
    'controller' => 'authController',
    'method' => 'signIn'
  ],
  '/logout/' => [
    'controller' => 'authController',
    'method' => 'logout'
  ],
  '/new-account/' => [
    'controller' => 'authController',
    'method' => 'newAccount'
  ],
  '/new-account/:token/' => [
    'controller' => 'authController',
    'method' => 'newAccount'
  ],
  '/new-password/' => [
    'controller' => 'authController',
    'method' => 'newPassword'
  ],
  '/new-password/:token/' => [
    'controller' => 'authController',
    'method' => 'newPassword'
  ],


  '/settings/' => [
    'controller' => 'settingsController',
    'method' => 'index'
  ],

  '/settings/lists/' => [
    'controller' => 'settingsController',
    'method' => 'lists'
  ],
  '/settings/lists/new/' => [
    'controller' => 'settingsController',
    'method' => 'newList'
  ],

  '/settings/teams/' => [
    'controller' => 'settingsController',
    'method' => 'teams'
  ],
  '/settings/teams/new-team/' => [
    'controller' => 'settingsController',
    'method' => 'newTeam'
  ],
  '/settings/teams/:team/' => [
    'controller' => 'settingsController',
    'method' => 'team'
  ],
  '/settings/teams/:team/new-member/' => [
    'controller' => 'settingsController',
    'method' => 'newMember'
  ],

  '/settings/account/' => [
    'controller' => 'settingsController',
    'method' => 'account'
  ],
  '/settings/account/change-email/' => [
    'controller' => 'settingsController',
    'method' => 'changeEmail'
  ],
  '/settings/account/change-password/' => [
    'controller' => 'settingsController',
    'method' => 'changePassword'
  ],


  '/:team/:list/:todo/' => [
    'controller' => 'listsController',
    'method' => 'todo'
  ],
  '/:team/important/' => [
    'controller' => 'listsController',
    'method' => 'important'
  ],
  '/:team/today/' => [
    'controller' => 'listsController',
    'method' => 'today'
  ],
  '/:team/week/' => [
    'controller' => 'listsController',
    'method' => 'week'
  ],
  '/:team/:list/' => [
    'controller' => 'listsController',
    'method' => 'list'
  ],
  '/:team/' => [
    'controller' => 'listsController',
    'method' => 'all'
  ]

];


function routing($requestUri, $routes){
  foreach($routes as $route => $routeSettings) {
    $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route)) . "$@D";
    $matches = Array();

    if(preg_match($pattern, $requestUri, $matches)) {
      array_shift($matches);
      $routeSettings['attributes'] = $matches;
      return $routeSettings;
    }
  }
}

$route = routing($requestUri, $routes);

if(!empty($route)) {
  $controller = $container->make($route['controller']);
  $method = $route['method'];
  $controller->$method($route['attributes']);
} else {
  if($requestUri == '/s.css') {
    header('Content-Type: text/css');
    include __DIR__ . '/s.css';
  }  
}

?>