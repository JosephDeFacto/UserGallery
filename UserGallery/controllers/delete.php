<?php 

require '../autoloader.php';

$user = new User();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$user->id = $id;

if ($user->delete($id)) {
	header('Location: ../index.php');
}