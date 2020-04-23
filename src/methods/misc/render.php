<?php

function render($view, $params) {
	extract($params);
	include __DIR__ . '/../../../dist/views/' . $view . '.php';
}