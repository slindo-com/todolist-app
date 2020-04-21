<?php

//
function translationsGet($lang) {
	include_once __DIR__ . '/../Translations/' . $lang . '.php';
	$GLOBALS['translations'] = TRANSLATIONS();
}

//
function i18n($key) {
	echo $GLOBALS['translations'][$key];
}

//
function getTranslation($key) {
	return $GLOBALS['translations'][$key];
}