<?php
session_start();
//connect to the database
require('../model/database.php');

if(isset($_POST['upload_avatar']))
{
	global $conn;

	$temp = $_FILES['client_image']['tmp_name'];
	$nameOrig = $_FILES['client_image']['name'];
	$ext = '.' . pathinfo($nameOrig,PATHINFO_EXTENSION);

	$name = $_SESSION['user'] . $ext;
	move_uploaded_file($temp,"../images/profile_images/".$name);

	$stmt = $conn->prepare("UPDATE members SET ClientImage = :clientImage WHERE Username = :username");
	$stmt->bindValue(':clientImage', "../images/profile_images/".$name);
	$stmt->bindValue(':username', $_SESSION['user']);
	$result = $stmt->execute();
	header('location: ../view/edit_profile.php');
}
?>
