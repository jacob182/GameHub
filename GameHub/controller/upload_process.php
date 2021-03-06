<?php

session_start();
//connect to the database
require('../model/database.php');
require('../model/function_members.php');


if(isset($_POST['submit_file']))
{
  global $conn;

  $user = get_member($_SESSION['user']);
  $temp = $_FILES['file']['tmp_name'];
  $nameOrig = $_FILES['file']['name'];
  $ext = '.' . pathinfo($nameOrig,PATHINFO_EXTENSION);
  if($ext != '.mp4' && $ext != '.avi') {
    $_SESSION['error'] = 'File is not compatibale. Please try again.';
    die(header('location: ../view/profile.php'));
  }

  $name = base64_encode(mt_rand(0,1000) . mt_rand(0, 1000)) . $ext;
  move_uploaded_file($temp,"../videos/uploads/".$name);

  $stmt = $conn->prepare("INSERT INTO `videos` (`Vid_name`, member_ID, `Vid_url`, `Vid_Description`, `Date_added`) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute(array($nameOrig, $user['member_ID'], "videos/uploads/{$name}", $_POST['vid-description'], time()));
}

if(isset($_POST['submit_file']))
{header('location: ../view/profile.php');
} else{
  $_SESSION['error'] = 'File is not compatibale. Please try again.';
  (header('location: ../view/profile.php'));
}
 ?>
