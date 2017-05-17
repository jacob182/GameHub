<<<<<<< HEAD
<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/function_members.php');
?>

<?php
    //retrieve the  details into the form
  $oldpassword = $_POST['old-password'];
  $password = $_POST['password'];
  $confirmnewpassword = $_POST['confirm-new-password'];


  if (empty($oldpassword, $password, $confirmnewpassword))
  {
    $_SESSION['error'] = 'All * fields are required.';
    header("location:../view/edit_profile.php");
    exit();
  }
  elseif ($password != $confirmnewpassword)
  {

  $_SESSION['error'] = 'Please enter the same password.';
  header("location:../view/signup.php");
  exit();
  }
  else {
  $result = edit_password($password);
    if($result) {
      $_SESSION['success'] = 'password successfully updated';
      header("location:../view/edit_profile.php");
    }
}

?>

<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/function_members.php');
?>

<?php
    //retrieve the  details into the form
  $password = $_POST['password'];
  $newpassword = $_POST['new-password'];
  $confirmnewpassword = $_POST['confirm-new-password'];


  if (empty($password, $newpassword, $confirmnewpassword))
  {
    $_SESSION['error'] = 'All * fields are required.';
    header("location:../view/edit_profile.php");
    exit();
  }
  elseif ($newpassword != $confirmnewpassword)
  {

  $_SESSION['error'] = 'Please enter the same password.';
  header("location:../view/signup.php");
  exit();
  }
  else {
  $result = edit_password($newpassword, $confirmnewpassword);
    if($result) {
      $_SESSION['success'] = 'password successfully updated';
      header("location:../view/edit_profile.php");
    }
}

?>
