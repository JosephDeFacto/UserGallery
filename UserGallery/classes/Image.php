<?php 

require_once 'Database.php';

class Image extends Database {

	public $connection;

	public $fileTmpPath;
	public $fileName;
	public $fileSize;
	public $fileType;
	public $uploadFileDir = '../uploads/';
	public $ext;
	public $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");


	public function __construct() {
		/*
		$this->connection = new Database();
		$this->connection = $this->connection->connect();
		*/
	}

	public function upload() {

		if (!empty($_FILES['fileUpload']['name'])) {

			$this->fileName = $_FILES['fileUpload']['name'];
			$this->fileType = $_FILES['fileUpload']['type'];
			$this->fileSize = $_FILES['fileUpload']['size'];
			//$this->ext = pathinfo($this->fileName, PATHINFO_EXTENSION);

			$this->ext = pathinfo($this->fileName, PATHINFO_EXTENSION);

			if (!array_key_exists($this->ext, $this->allowed)) {

				die("Select a valid file format.");
			}

			$maxFilesize = 5 * 1024 * 1024;

			if ($this->fileSize > $maxFilesize) {
				die("Maximum size for image: " . $maxFilesize);
			}
			
			move_uploaded_file($_FILES['fileUpload']['tmp_name'], $this->uploadFileDir . $this->fileName);
		}
	}
	
	public function path() {

		return __DIR__ . "/" . $this->directory . $this->filename;
	}

	public function getErrors() {

		return $this->errors;
	}
}

?>


