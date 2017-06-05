<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/function_members.php');
?>

<?php
	//retrieve the registration details into the form
  $username = $_POST['username'];
	$confirmemail = $_POST['confirm-email'];
	$confirmpassword = $_POST['confirm-password'];
	$email = $_POST['email'];
	$password = $_POST['password'];

//validation

if (empty($email) || empty($username) || empty($password))
{
	$_SESSION['error'] = 'All fields are required!';
	header("location:/view/signup.php");
	exit();
}
elseif (strlen($password) < 7)
	{
		$_SESSION['error'] = 'Password must be 7 characters or more.';
		header("location:/view/signup.php");
		exit();
	}

elseif ($email != $confirmemail)
{
	$_SESSION['error'] = 'Please enter the same email address.';
	header("location:/view/signup.php");
	exit();
}

elseif ($password != $confirmpassword)
{
$_SESSION['error'] = 'Please enter the same password.';
header("location:/view/signup.php");
exit();
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
  	$_SESSION['error'] = 'Please enter a valid email address.';
  	header("location:/view/signup.php");
    exit();
  }

$count = count_username($username);

    if($count > 0)
  	{
  		$_SESSION['error'] = 'Username taken. Please retry.';
  		header("location:/view/signup.php");
  		exit();
  	}
				$password = passHash($password);

    //call the add_user() function
    	$result = add_member($email, $username, $password);

    	//create user messages
    	if($result)
    	{
    		//create a success message
    		$_SESSION['success'] = 'Thank you for creating an account. Please login.';
    		//redirect to products.php
    		header('location:/view/login.php');
    	}
    	else
    	{
    		//create an error message
    		$_SESSION['error'] = 'An error has occurred. Please try again.';
				var_dump($result);
    		//redirect to signup.php
    		header('location:/view/signup.php');
    	}
    ?>
