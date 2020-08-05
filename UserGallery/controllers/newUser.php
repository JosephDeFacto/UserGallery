<?php 

require '../autoloader.php';
require '../includes/header.php';

//$validation = new Validation();
$user = new User();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	if (!empty($_FILES['avatar']['name'])) {
		$user->firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
		$user->lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
		$user->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
		$user->avatar = $_FILES['avatar']['name'];
		$avatar = $user->avatar;
		//var_dump($avatar);
		//die("Something");
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES['avatar']['name']);
		$type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$allowed = array("jpg", "jpeg", "gif", "png");
		// if there are values
		if (in_array($type, $allowed)) {
			$imageBase64 = base64_encode(file_get_contents($_FILES['avatar']['tmp_name']));
			$image = 'data:image/' . $type . ';base64,' . $imageBase64;

			//move_uploaded_file($_FILES['avatar']['tmp_name'], $target_dir.$avatar);
			move_uploaded_file($_FILES['avatar']['tmp_name'], $target_dir.$avatar);
			echo '<img src"' . $avatar . '">';
			//die();
		}

		if ($user->newUser()) {
			header('Location: ../index.php');
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>New User</title>
</head>
<body>
	<p>Create new user</p>
	<div class="container">
		<form action="newUser.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<legend>Insert new user</legend>
				<div class="row">
					<div class="col-sm-1">
						<label for="firstname">First Name</label>
						<input type="text" name="firstname" id="firstname" placeholder="Your First Name..."/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<label for="lastname">Last Name</label>
						<input type="text" name="lastname" id="lastname" placeholder="Your Last Name..">
					</div>
				</div>

				<div class="row">
					<div class="col-sm-3">
						<label for="description">Description</label>
						<textarea id="description" name="description" rows="4" cols="30"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<label for="avatar">Upload Your Profile Image</label>
						<input type="file" name="avatar" id="avatar">
					</div>
				</div>


				<input type="submit" class="primary small" name="submit" value="Submit"/>

			</fieldset>
		</form>
	</div>
</body>
</html>