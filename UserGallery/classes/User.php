<?php

require_once 'Database.php';

class User extends Database {

	public $id;
	public $firstname;
	public $lastname;
	public $description;
	public $avatar;

	public $connection = null;

	public function __construct() {

		$this->connection = new Database();
		$this->connection = $this->connection->connect();

	}
    // -------------------------------------------------------------
	public function newUser() {

		$stmt = $this->connection->prepare("INSERT INTO users (firstname, lastname, description, avatar) 
											VALUES (:firstname, :lastname, :description, :avatar)");
		$stmt->bindParam(':firstname', $this->firstname);
		$stmt->bindParam(':lastname', $this->lastname);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':avatar', $this->avatar);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function edit() {

		$stmt = $this->connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, description = :description, avatar = :avatar WHERE id = :id");
		$stmt->bindParam(':firstname', $this->firstname);
		$stmt->bindParam(':lastname', $this->lastname);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':avatar', $this->avatar);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	public function delete($id) {

		$sql = "DELETE FROM users WHERE id = :id";

		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		if ($stmt) {
			return true;
		}
		return false;
	}

	public function delete_avatar() {
		$sql = "DELETE avatar FROM users WHERE id = :id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':id', $this->id);

		$stmt->execute();
	}

	public function allUsers() {

		$sql = "SELECT * FROM users";
		$stmt = $this->connection->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

	public function getUser() {

		$sql = "SELECT id, firstname, lastname, description, avatar FROM users WHERE id = :id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->firstname = $row['firstname'];
		$this->lastname = $row['lastname'];
		$this->description = $row['description'];
		$this->avatar = $row['avatar'];

		return $row;
	}

	public function show_profile($id) {

		$rows = array();
		$sql = "SELECT firstname, lastname, description, avatar FROM users WHERE id = :id";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();
		//$row = $stmt->fetch(PDO::FETCH_ASSOC);
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function getFullName() {

		return $this->firstname . " " . $this->lastname;
	}


	public function getID() {

		return $this->id;
	}
}

/* UPDATE `users` SET `last_login` = CURRENT_TIMESTAMP WHERE `id` = 1; */




