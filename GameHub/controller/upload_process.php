<?php

session_start();
//connect to the database
require('../model/database.php');


if(isset($_POST['submit_file']))
{
  global $conn;

  $temp = $_FILES['file']['tmp_name'];
  $nameOrig = $_FILES['file']['name'];
  $ext = '.' . pathinfo($nameOrig,PATHINFO_EXTENSION);
  if($ext != '.mp4' && $ext != '.avi') {
    $_SESSION['error'] = 'File is not compatibale. Please try again.';
    die(header('location: /gamehub/view/profile.php'));
  }

  $name = base64_encode(mt_rand(0,1000) . mt_rand(0, 1000)) . $ext;
  move_uploaded_file($temp,"../videos/uploads/".$name);

  $stmt = $conn->prepare("INSERT INTO `videos` (`Vid_name`, Username, `Vid_url`, `Vid_Description`, `Date_added`) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute(array($nameOrig, $_SESSION['user'], "videos/uploads/{$name}", $_POST['vid-description'], time()));
}

if(isset($_POST['submit_file']))
{header('location: /gamehub/view/profile.php');
} else{
  echo"nope";
}
 ?>
