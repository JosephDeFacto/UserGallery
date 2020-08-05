<?php 

require '../includes/header.php';
require '../autoloader.php';


$user = new User();

$user->id = isset($_GET['id']) ? $_GET['id'] : null;

$show_profile = $user->getUser();

?>
<table>
	<tr>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Description</th>
		<th>Profile Picture</th>
		<th></th>
	</tr>
	<tr>
		<td><?php echo $show_profile['firstname']; ?></td>
		<td><?php echo $show_profile['lastname']; ?></td>
		<td><?php echo $show_profile['description']; ?></td>
		<td><?php echo "<img src='../uploads/". $show_profile['avatar']."'>";?></td>
		<td><a href="gallery.php?id=<?php echo $show_profile['id']; ?>">Gallery</a></td>
	</tr>
</table>