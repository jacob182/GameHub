<?php
	//require necessary functions
	session_start();
	require ('../model/database.php');
	require('../model/function_members.php');

	//Ensure the valid ID is set in the URL
	if(!isset($_GET['username'])) header('location: ../view/feed.php');
	//ensure the request is sent from a logged in user
	if(!isLogged()) header('location: ../view/feed.php');
	
	//Set the database variable to global
	global $conn;
	
	//make sure the follow request is for a valid set of users
	$user = get_member($_GET['username']);
	//redirect if not
	if(!$user) header('location: ../view/feed.php');

	
	//Check to see if user is already following the other, if so unfollow
	$stmt = $conn->prepare("SELECT * FROM `followers` WHERE `followerID` = ? AND `followingID` = ?");
	$stmt->execute(array($_SESSION['user'], $_GET['username']));
	$check = $stmt->fetch();
	if(empty($check)) {
		//create the follow entry
		$stmt = $conn->prepare("INSERT INTO `followers` (`followerID`, `followingID`) values (?, ?)");
		$stmt->execute(array($_SESSION['user'], $_GET['username']));
		
		//Update meta  for followers and following counters displayed on the profile page.
		$stmt = $conn->prepare("UPDATE `members` SET `following` = following + 1 WHERE `Username`= ?");
		$stmt->execute(array($_SESSION['user']));
		$stmt = $conn->prepare("UPDATE `members` SET `followers` = followers + 1 WHERE `Username`= ?");
		$stmt->execute(array($_GET['username']));
	} else {
		//Remove the follow entry
		$stmt = $conn->prepare("DELETE FROM `followers` WHERE `followerID` = ? AND `followingID` = ?");
		$stmt->execute(array($_SESSION['user'], $_GET['username']));
		
		//Update meta  for followers and following counters displayed on the profile page.
		$stmt = $conn->prepare("UPDATE `members` SET `following` = following - 1 WHERE `Username`= ?");
		$stmt->execute(array($_SESSION['user']));
		$stmt = $conn->prepare("UPDATE `members` SET `followers` = followers - 1 WHERE `Username`= ?");
		$stmt->execute(array($_GET['username']));
	}
	
	//redirect after successful process
	header('location: ../view/profile.php?username=' . $_GET['username']);
	
?>