<?php

session_start();

require __DIR__ . "/../init.php";

$routes = [
	'/unsubscribe/:token/' => [
		'controller' => 'SystemController',
		'method' => 'systemControllerUnsubscribe'
	],

	'/sign-in/' => [
		'controller' => 'AuthController',
		'method' => 'authControllerSignIn'
	],
	'/new-account/' => [
		'controller' => 'AuthController',
		'method' => 'authControllerNewAccount'
	],
	'/new-account/:token/' => [
		'controller' => 'AuthController',
		'method' => 'authControllerNewAccount'
	],
	'/new-password/' => [
		'controller' => 'AuthController',
		'method' => 'authControllerNewPassword'
	],
	'/new-password/:token/' => [
		'controller' => 'AuthController',
		'method' => 'authControllerNewPassword'
	],


	'/settings/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerIndex'
	],

	'/settings/lists/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerLists'
	],
	'/settings/lists/new/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerNewList'
	],

	'/settings/teams/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerTeams'
	],
	'/settings/teams/:team/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerTeam'
	],
	'/settings/teams/:team/edit-title/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerEditTeamTitle'
	],
	'/settings/teams/:team/invite/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerInviteTeamMember'
	],

	'/settings/account/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerAccount'
	],
	'/settings/account/change-email/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerChangeEmail'
	],
	'/settings/account/change-email/:token/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerChangeEmailToken'
	],
	'/settings/account/change-password/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerChangePassword'
	],
	'/settings/account/change-pic/' => [
		'controller' => 'SettingsController',
		'method' => 'settingsControllerChangePic'
	],


	'/:team/:list/:todo/' => [
		'controller' => 'ListsController',
		'method' => 'listsControllerTodo'
	],
	'/:team/important/' => [
		'controller' => 'ListsController',
		'method' => 'listsControllerImportant'
	],
	'/:team/today/' => [
		'controller' => 'ListsController',
		'method' => 'listsControllerToday'
	],
	'/:team/week/' => [
		'controller' => 'ListsController',
		'method' => 'listsControllerWeek'
	],
	'/:team/:list/' => [
		'controller' => 'ListsController',
		'method' => 'listsControllerList'
	],
	'/:team/' => [
		'controller' => 'ListsController',
		'method' => 'listsControllerAll'
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

	include_once __DIR__ .'/../src/Controllers/'. $route['controller'] .'.php'; 
	$route['method']($route['attributes'], $route['query']);


} else {
	if($_SERVER['REQUEST_URI'] == '/s.css') {
		sendCacheHeaders();
		header('Content-Type: text/css');
		include __DIR__ . '/s.css';
	}  else {

		$fileType = substr($_SERVER['REQUEST_URI'], -3);

		if($fileType == 'png') {
			sendCacheHeaders();
			substr($_SERVER['REQUEST_URI'], 5, 20);
			header('Content-Type: image/png');
			include __DIR__ . '/pics/'. substr($_SERVER['REQUEST_URI'], 6, 20) .'.png';
		}
	}
}

function sendCacheHeaders() {
	$min = 1440;
	$expires = date("M d Y H:i:s", mktime(0, 0, 0, 1, 1, 2040));
	$modified = date("M d Y H:i:s", mktime(0, 0, 0, 1, 1, 2010));

	header("Expires: " . $expires);
	header("Last-Modified: " . $modified);
	header("Cache-Control: public, max-age=" . $min * 60);
	header("Pragma: max-age=" . $min * 60);
}