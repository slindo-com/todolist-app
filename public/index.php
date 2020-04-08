<?php

session_start();

require __DIR__ . "/../init.php";

$routes = [
	'/sign-in/' => [
		'controler' => 'AuthController',
		'function' => 'authControllerSignIn'
	],
	'/new-account/' => [
		'controler' => 'AuthController',
		'function' => 'authControllerNewAccount'
	],
	'/new-account/:token/' => [
		'controler' => 'AuthController',
		'function' => 'authControllerNewAccount'
	],
	'/new-password/' => [
		'controler' => 'AuthController',
		'function' => 'authControllerNewPassword'
	],
	'/new-password/:token/' => [
		'controler' => 'AuthController',
		'function' => 'authControllerNewPassword'
	],


	'/settings/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerIndex'
	],

	'/settings/lists/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerLists'
	],
	'/settings/lists/new/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerNewList'
	],

	'/settings/teams/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerTeams'
	],
	'/settings/teams/:team/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerTeam'
	],
	'/settings/teams/:team/edit-title/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerEditTeamTitle'
	],
	'/settings/teams/:team/invite/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerInviteTeamMember'
	],

	'/settings/account/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerAccount'
	],
	'/settings/account/change-email/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerChangeEmail'
	],
	'/settings/account/change-email/:token/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerChangeEmailToken'
	],
	'/settings/account/change-password/' => [
		'controler' => 'settingsController',
		'function' => 'settingsControllerChangePassword'
	],


	'/:team/:list/:todo/' => [
		'controler' => 'listsController',
		'function' => 'listsControllerTodo'
	],
	'/:team/important/' => [
		'controler' => 'listsController',
		'function' => 'listsControllerImportant'
	],
	'/:team/today/' => [
		'controler' => 'listsController',
		'function' => 'listsControllerToday'
	],
	'/:team/week/' => [
		'controler' => 'listsController',
		'function' => 'listsControllerWeek'
	],
	'/:team/:list/' => [
		'controler' => 'listsController',
		'function' => 'listsControllerList'
	],
	'/:team/' => [
		'controler' => 'listsController',
		'function' => 'listsControllerAll'
	]

];


function routing($requestUri, $routes){
	$requestUriParts = explode('?', $requestUri);
	$uri = $requestUriParts[0];
	if(!empty($requestUriParts[1])) {
		$queryParts = explode('&', $requestUriParts[1]);

		$query = [];
		foreach($queryParts as $queryPart) {
			$queryAttrAndVal = explode('=', $queryPart);
			$query[$queryAttrAndVal[0]] = $queryAttrAndVal[1];
		}
	}
	


	foreach($routes as $route => $routeSettings) {
		$pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route)) . "$@D";
		$matches = Array();

		if(preg_match($pattern, $uri, $matches)) {
			array_shift($matches);
			$routeSettings['attributes'] = $matches;
			$routeSettings['query'] = !empty($query) ? $query : [];
			return $routeSettings;
		}
	}
}

$route = routing($_SERVER['REQUEST_URI'], $routes);

if(!empty($route)) {

	if(!empty($route['function'])) {
		include_once __DIR__ .'/../src/Controllers/'. $route['controler'] .'.php'; 
		$route['function']($route['attributes'], $route['query']);
	} else {
		$controller = $container->make($route['controller']);
		$method = $route['method'];
		$controller->$method($route['attributes']);	
	}

} else {
	if($_SERVER['REQUEST_URI'] == '/s.css') {

		$min = 1440;
		$expires = date("M d Y H:i:s", mktime(0, 0, 0, 1, 1, 2040));
		$modified = date("M d Y H:i:s", mktime(0, 0, 0, 1, 1, 2010));

		header("Expires: " . $expires);
		header("Last-Modified: " . $modified);
		header("Cache-Control: public, max-age=" . $min * 60);
		header("Pragma: max-age=" . $min * 60);

		header('Content-Type: text/css');
		include __DIR__ . '/s.css';
	}  
}