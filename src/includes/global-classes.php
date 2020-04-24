<?php

//
abstract class AbstractAsset implements ArrayAccess {

	public function offsetExists($offset) {
		return isset($this->$offset);
	}

	public function offsetGet($offset) {
		return $this->$offset;
	}

	public function offsetSet($offset, $value) {
		$this->$offset = $value;
	}

	public function offsetUnset($offset) {
		unset($this->$offset);
	}
}

//
class F {
	public static function __callStatic($m, $args) {

		if (!function_exists($m)) {
			include_once __DIR__ . '/../methods/' . $GLOBALS['methods'][$m] . '.php';
		}
		return call_user_func_array($m, $args);
	}
}

//
class M {
	public static function __callStatic($m, $args) {

		if (!function_exists($m)) {
			include_once __DIR__ . '/../models/' . strtolower($m) . '.php';
		}
		return call_user_func_array($m, $args);
	}
}

//
class MAIL {
	public static function __callStatic($m, $args) {

		if (!function_exists($m)) {
			include_once __DIR__ . '/../templates/en/' . strtolower($m) . '.php';
		}
		return call_user_func_array($m, $args);
	}
}
