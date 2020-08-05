<?php 

require_once 'Database.php';

class Admin extends Database {

	public $connection = null;

	public function __construct() {

		$this->connection = new Database();
		$this->connection = $this->connection->connect();
	}

	public function login($username, $email, $password) {
		$hash_password = hash('sha256', $password);
		
		$stmt = $this->connection->prepare("SELECT username, email, password FROM admin WHERE username = :username OR email = :email OR password = :hash_password");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

		return $stmt;
	}

	public function logout() {

		Session::getInstance()->logout();
	}
}


?>

