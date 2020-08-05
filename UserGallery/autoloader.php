<?php

/*
** AUTOLOADER
*/

class Autoloader {
	
	public static function register() {

		spl_autoload_register(function ($class) {
			if (file_exists(__DIR__ . "/classes/{$class}.php")) {
				require_once __DIR__ . "/classes/{$class}.php";
				return true;
			}
			return false;
		});
	}
}

Autoloader::register();
