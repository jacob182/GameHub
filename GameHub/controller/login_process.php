<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/function_members.php');

	//retrieve the username and password entered into the form
	$username = $_POST['username'];
	$password = $_POST['password'];

	//call the retrieve_salt() function


	//call the login() function
		$count = login($username, $password);

		if (empty($email) || empty($username) || empty($password))
		{
			$_SESSION['error'] = 'Incorrect username or password. Please try again.';
			header("location:/view/login.php");
			exit();
		}
		//if there is one matching record
		if($count == 1)
        {
            //start the user session to allow authorised access to secured web pages
            $_SESSION['user'] = $username;
            //redirect to products.php
            header('location:/view/feed.php');
        }
        else if ($count == 2) {
            $_SESSION['error'] = 'Your account is banned';
            header('location:/view/login.php');
        }
        else
        {
            //if login not successful, create an error message to display on the login page
            $_SESSION['error'] = 'Incorrect username or password. Please try again.';
            header('location:/view/login.php');
        }
?>
