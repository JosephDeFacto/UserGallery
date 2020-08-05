<?php 

require '../includes/header.php';
require '../autoloader.php';

$user = new User();

$user->id = isset($_GET['id']) ? $_GET['id'] : null;
$user->getUser();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
	if (!empty($_FILES['avatar']['name'])) {
	//$user->id = $_POST['id']
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
			unlink($target_dir . $user->avatar);

			move_uploaded_file($_FILES['avatar']['tmp_name'], $target_dir.$user->avatar);

			//echo '<img src"' . $avatar . '">';
			//die();
		}
		if ($user->edit()) {
			header('Location: ../index.php');
		}
	}
}

?>

<div class="container">
	<a href="../index.php">Home</a>
	<form action="edit.php" method="POST" enctype="multipart/form-data">
		<fieldset>
			<legend>Edit user</legend>
			<div class="row">
				<div class="col-sm-1">
					<label for="firstname">First Name</label>
					<input type="text" name="firstname" id="firstname" value="<?php echo $user->firstname; ?>" placeholder="Your First Name..."/>
				</div>
				</div>

			<div class="row">
				<div class="col-sm-2">
					<label for="lastname">Last Name</label>
					<input type="text" name="lastname" id="lastname" value="<?php echo $user->lastname; ?>" placeholder="Your Last Name..">
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
					<label for="avatar">Profile Picture</label>
					<?php echo "<img src='../uploads/" . $user->avatar . "'>"?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-2">
					<label for="avatar">Edit/Set new</label>
					<input type="file" name="avatar" id="avatar" value="<?php echo "<img src='../uploads/" . $avatar . "'>"; ?>">
				</div>
			</div>

			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" class="primary small" name="update" value="Submit"/>

		</fieldset>
	</form>
</div>

