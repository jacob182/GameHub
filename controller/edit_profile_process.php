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
  $username = $_POST['username'];
  $email = $_POST['email'];

  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];
  $confirmNewPassword = $_POST['confirmNewPassword'];



  if (empty($email))
  {
    $_SESSION['error'] = 'Please enter a valid email address.';
    header("location:../view/edit_profile.php");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
    	$_SESSION['error'] = 'Please enter a valid email address.';
    	header("location:../view/edit_profile.php");
      exit();
    }
  else {
    $result = edit_profile($email, $username);
      if($result) {
        $_SESSION['success'] = 'profile successfully updated';
      }
    if(!empty($oldPassword) && !empty($newPassword) && !empty($confirmNewPassword)) {
		edit_password($oldPassword, $newPassword, $confirmNewPassword);
	}

}
header("location:../view/edit_profile.php");
?>
