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
	$following = get_member($_GET['username'])['member_ID'];
	$follower = get_member($_SESSION['user'])['member_ID'];
	//redirect if not
	if(!$following) header('location: ../view/feed.php');


	//Check to see if user is already following the other, if so unfollow
	$stmt = $conn->prepare("SELECT * FROM `followers` WHERE `followerID` = ? AND `followingID` = ?");
	$stmt->execute(array($follower, $following));
	$check = $stmt->fetch();
	if(empty($check)) {
		//create the follow entry
		$stmt = $conn->prepare("INSERT INTO `followers` (`followerID`, `followingID`) values (?, ?)");
		$stmt->execute(array($follower, $following));

		//Update meta  for followers and following counters displayed on the profile page.
		$stmt = $conn->prepare("UPDATE `members` SET `following` = following + 1 WHERE `member_ID`= ?");
		$stmt->execute(array($follower));
		$stmt = $conn->prepare("UPDATE `members` SET `followers` = followers + 1 WHERE `member_ID`= ?");
		$stmt->execute(array($following));
	} else {
		//Remove the follow entry
		$stmt = $conn->prepare("DELETE FROM `followers` WHERE `followerID` = ? AND `followingID` = ?");
		$stmt->execute(array($follower, $following));

		//Update meta  for followers and following counters displayed on the profile page.
		$stmt = $conn->prepare("UPDATE `members` SET `following` = following - 1 WHERE `member_ID`= ?");
		$stmt->execute(array($follower));
		$stmt = $conn->prepare("UPDATE `members` SET `followers` = followers - 1 WHERE `member_ID`= ?");
		$stmt->execute(array($following));
	}

	//redirect after successful process
	header('location: ../view/profile.php?username=' . $_GET['username']);

?>
