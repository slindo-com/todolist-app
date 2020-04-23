<?php

function translationsInit($lang) {
	include_once __DIR__ . '/../../../dist/translations/' . $lang . '.php';
	$GLOBALS['translations'] = TRANSLATIONS();
}