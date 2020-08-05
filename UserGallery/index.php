<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require 'autoloader.php';
require 'includes/header.php';

if (!Session::getInstance()->loggedIn()) {
	header('Location: controllers/admin_login.php');
}

Session::getInstance()->login();
 
$admin = new Admin();
$user = new User();

$users = $user->allUsers();

$rows = $users->rowCount();

if (isset($_GET['logout'])) {
 	$admin->logout();
 	header('Location: controllers/admin_login.php');
}


require 'includes/navigation.php'; 
?>
<a class="logout" href="index.php?logout=logout">Logout</a>

<table id="users">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Description</th>
		<th>Profile Picture</th>
		<th>Show Profile</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php
	if ($rows >= 0) {
		while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			?>
			<tr>
				<td><?php echo $row['firstname']; ?></td> 
				<td><?php echo $row['lastname']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td><?php echo "<img src='uploads/".$row['avatar']."'>";?></td>
				<td><a href="controllers/show_profile.php?id=<?php echo $row['id']; ?>">Show Profile</a></td>
				<td><a href="controllers/edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
				<td><a href="controllers/delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
			</tr>
			<?php
		}
	}
	?>
</table>

<?php require 'includes/footer.php'; ?>
