<?php

session_start();

include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../src/includes/routes.php';
include_once __DIR__ . '/../src/includes/methods.php';
include_once __DIR__ . '/../src/includes/global-classes.php';
include_once __DIR__ . '/../src/includes/global-methods.php';

$route = F::decryptRoute($_SERVER['REQUEST_URI'], $routes);

if (!empty($route)) {
	extract($route);

	F::translationsInit(!empty($_SESSION['language']) ? $_SESSION['language'] : 'en');

	include_once __DIR__ . '/../src/controllers/' . $view . '.php';
} else if ($_SERVER['REQUEST_URI'] == '/favicon.ico') {
	F::sendCacheHeaders();
	header('Content-Type: image/x-icon');
	include __DIR__ . '/favicon.ico';
} else if ($_SERVER['REQUEST_URI'] == '/fonts/ubuntu-regular.woff2') {
	F::sendCacheHeaders();
	header('Content-Type: font/woff2');
	include __DIR__ . '/fonts/ubuntu-regular.woff2';
} else if ($_SERVER['REQUEST_URI'] == '/fonts/ubuntu-medium.woff2') {
	F::sendCacheHeaders();
	header('Content-Type: font/woff2');
	include __DIR__ . '/fonts/ubuntu-medium.woff2';
} else if ($_SERVER['REQUEST_URI'] == '/fonts/ubuntu-bold.woff2') {
	F::sendCacheHeaders();
	header('Content-Type: font/woff2');
	include __DIR__ . '/fonts/ubuntu-bold.woff2';
} else if ($_SERVER['REQUEST_URI'] == '/s.css') {
	F::sendCacheHeaders();
	header('Content-Type: text/css');
	include __DIR__ . '/s.css';
} else if (substr($_SERVER['REQUEST_URI'], -3) == 'png') {
	F::sendCacheHeaders();
	substr($_SERVER['REQUEST_URI'], 5, 20);
	header('Content-Type: image/png');
	include __DIR__ . '/pics/' . substr($_SERVER['REQUEST_URI'], 6, 20) . '.png';
}