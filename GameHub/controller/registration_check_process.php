<?php
  //start session management
  session_start();
  //connect to the database
  require('../model/database.php');
  //retrieve the functions
  require('../model/function_members.php');

  if(isset($_POST['username'])){
    $username = $_POST['username'];
    $count = count_username($username);
    if($count > 0){
      echo "usernameERROR";
      exit();
    } else {
      echo "usernameOK";
    }
  }
  if(isset($_POST['email'])){
    $email = $_POST['email'];
    $count = count_email($email);
    if($count > 0){
      echo "emailERROR";
      exit();
    } else {
      echo "emailOK";
    }
  }
?>
