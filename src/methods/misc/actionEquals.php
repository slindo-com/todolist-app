<?php

function actionEquals($a) {
	return !empty($_POST['a']) && $_POST['a'] == $a;
}