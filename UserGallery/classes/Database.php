<?php 

class Database {

	protected $host = 'localhost';
	protected $user = 'root';
	protected $pass = '';
	protected $dbname = 'gallery';
	protected $connection;

	public function connect() {

		try {
			$this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
			//echo "Connected<br>";
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}

		return $this->connection;
	}
}