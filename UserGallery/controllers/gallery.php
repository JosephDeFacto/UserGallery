<?php 

require '../includes/header.php';
require '../autoloader.php';


$user = new User();

$user->id = isset($_GET['id']) ? $_GET['id'] : null;

$show_profile = $user->getUser();

$images_dir = "../uploads/";
 
if(is_dir($images_dir)) {
	$opendirectory = opendir($images_dir);
  
    while (($image = readdir($opendirectory)) !== false) {
		if(($image == '.') || ($image == '..'))
		{
			continue;
		}
		
		$imgFileType = pathinfo($image,PATHINFO_EXTENSION);
		
		if(($imgFileType == 'jpg') || ($imgFileType == 'jpeg') || ($imgFileType == "gif") || ($imgFileType == "png"))
		{
			echo "<img src='../uploads/" . $image . "' width='200'> ";
			//var_dump("<img src='images/".$image."' width='200'> ");
		}
    }
	
    closedir($opendirectory);
}
?>
