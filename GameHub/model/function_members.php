<?php
	//create a function to retrieve the total number of matching usernames
	function count_username($username)
	{
		global $conn;
		$sql = 'SELECT * FROM members WHERE username = :username';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$count = $statement->rowCount();
		return $count;
	}

	function add_member($email, $username, $password)
	{
		//establishing the connection to the database
		global $conn;
		$sql = "INSERT INTO members (email, username, password) VALUES (:email, :username, :password)";
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		//values binded to the parameters
		$statement->bindValue(':email', $email);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		//database executes statement
		$result = $statement->execute();
		//some drivers require this function to create an efficient connection to the server
		$statement->closeCursor();
		//result is returned to the database
		return $result;
	}

	function login($username, $password)
	{
	  global $conn;
	   $sql = 'SELECT `password` FROM members WHERE username = :username';
	  $statement = $conn->prepare($sql);
	  $statement->bindValue(':username', $username);
	  $statement->execute();
	  $result = $statement->fetchAll();
	  $statement->closeCursor();
		$count = $statement->rowCount();
		if($count != 0) {
			if(password_verify($password, $result[0]['password'])) {
				return 1;
			} else {
				return 0;
			}
		}

	  return $count;
	}

	function isLogged()
	{
	  if(isset($_SESSION['user'])) {
	    return true;
	  }
	  return false;
	}

	function get_member($username)
	{
		global $conn;
  	$sql = "SELECT * FROM members WHERE username = :username";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':username', $username);
  	$statement->execute();
  	$result = $statement->fetch();
  	$statement->closeCursor();
  	return $result;
	}

	function edit_profile($email, $username)
	{
		//establishing the connection to the database
		global $conn;
		//sql value is set to update profile information and connecting the values
		$sql = "UPDATE members SET email = :email WHERE username = :username";
		//preparing for sql query
		$statement = $conn->prepare($sql);
		//values binded to the parameters
		$statement->bindValue(':email', $email);
		$statement->bindValue(':username', $username);
		//result set and executed
		$result = $statement->execute();
		//some drivers require this function to create an efficient connection to the server
		$statement->closeCursor();
		//result is returned to the database
		return $result;
	}


	function edit_password($oldPassword, $newPassword, $confirmNewPassword)
	{
		global $conn;
	   $sql = 'SELECT password FROM members WHERE username = :username';
	  $statement = $conn->prepare($sql);
		$statement->bindValue(':username', $_SESSION['user']);
	  $statement->execute();
	  $result = $statement->fetchAll();
	  $statement->closeCursor();

		if (password_verify($oldPassword, $result[0]['password'])) {
			if($newPassword == $confirmNewPassword) {
				$sql = "UPDATE members SET password = :password WHERE username = :username";
				$stmt = $conn->prepare($sql);
				$password = password_hash($newPassword, PASSWORD_DEFAULT);
				$stmt->execute(array(
					'username' => $_SESSION['user'],
					'password' => $password
				));

				$_SESSION['success'] = "Profile and password succesffully updated!";
			} else {
				$_SESSION['error'] = 'The two passwords you have entered do not match';
			}
		} else {
			$_SESSION['error'] = 'Current Password incorrect!';
		}

		if (password_verify($password, $result[0]['password'])) {
			//current password is correct
			$sql = "UPDATE members SET password = :password WHERE username = :username";
			$stmt = $conn->prepare($sql);
			$password = password_hash($password, PASSWORD_DEFAULT);
			$stmt->execute(array(
				'username' => $_SESSION['user'],
				'password' => $password
			));
			//
		}

	  return $count;

	}

		function delete_profile()
	{
		//establishing the connection to the database
		global $conn;
		//sql value is set to delete user information and connecting values
		$sql = "DELETE FROM members WHERE username = :username";
		//preparing for sql query
		$statement = $conn->prepare($sql);
		//value linked to the correct variable
		$statement->bindValue(':username', $_SESSION['user']);
		//result set and executed
		$result = $statement->execute();
		//some drivers require this function to create an efficient connection to the server
		$statement->closeCursor();
		session_destroy();
		//result is returned to the database
		return $result;
	}
		?>
