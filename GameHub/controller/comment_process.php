<?php
  session_start();
  //connect to the database
  require('../model/database.php');

  $commenttxt = $_POST['comment_txt'];

  if(isset($_POST['post_comment']))
  {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO `comments` (`Vid_ID`, Username, `Comment_txt`, `date_added`) VALUES (?, ?, ?, ?)");
    $stmt->execute(array($_POST['Vid_ID'], $_SESSION['user'], $_POST['comment_txt'], time()));
  }

  if(isset($_POST['post_comment']))
  {header('location: ../view/feed.php');
    echo"<br /> Comment has been submitted";
  } else{
    echo'NOPE';
  }
 ?>
