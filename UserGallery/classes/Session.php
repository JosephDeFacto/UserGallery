<?php 

class Session {

	private static $instance;

	private function __construct() {

		session_start();
	}

	public static function getInstance() {

		if(!self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	// login
	public static function login() {

		$_SESSION['isLoggedIn'] = true;
	}
	// logout
	public static function logout() {

		session_destroy();
		unset($_SESSION['isLoggedIn']);
	}
	// for admin; admin must be logged-in to actually manage users
	public static function loggedIn() {

		$isLoggedIn = isset($_SESSION['isLoggedIn']) ? true : false;

		return $isLoggedIn;
	}
}