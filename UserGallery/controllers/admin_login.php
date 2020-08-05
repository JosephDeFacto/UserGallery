<?php 

require '../autoloader.php';
require '../includes/header.php';

	
$admin = new Admin();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$username = htmlentities($_POST['username']);
	$email = htmlentities($_POST['email']);
	$password = htmlentities($_POST['password']);

	if ($admin->login($username, $email, $password)) {
		//header('Location: ../index.php');
		Session::getInstance()->login();
		header('Location: ../index.php');
	}
}	

?>

<div class="container">
	<p><b>You must log-in</b></p>
		<form action="admin_login.php" method="POST">
			<fieldset>
				<legend>Login</legend>
				<br>
				
				<div class="row">
					<div class="col-sm-1">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" placeholder="Username..."/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" placeholder="Email...">
					</div>
				</div>

				<div class="row">
					<div class="col-sm-3">
						<label for="description">Description</label>
						<input type="text" name="password" id="password" placeholder="Password...">
					</div>
				</div>

				<input type="submit" class="primary small" name="submit" value="Submit"/>

			</fieldset>
		</form>
	</div>