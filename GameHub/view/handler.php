<?php
	session_start();
  if(!isset($_GET['action'])) die(header('location: ../view/profile.php'));
  include('../model/database.php');
  include('../model/function_members.php');
  global $conn;
  switch($_GET['action']) {
    case "comments":
      if(!isset($_GET['Vid_ID'])) die('Improper usage!');

      $stmt = $conn->prepare("SELECT * FROM `comments` WHERE `Vid_ID` = ? ORDER BY `Date_added`");
      $stmt->execute(array($_GET['Vid_ID']));

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //Differentiate comments from comments created by logged in user in order to display moderation links
	  for($i = 0; $i < count($results); $i++) {
		  $results[$i]['owned'] = 0;
		  if(isLogged()) {
				$user = get_member($_SESSION['user']);
        if($user['member_ID'] == $results[$i]['member_ID']) {
				  $results[$i]['owned'] = 1;
			  }
		  }

			//Append avatar url to comments
	        $avatar = get_member_by_id($results[$i]['member_ID']);
	        $results[$i]['ClientImage'] = get_avatar($avatar['Username']);

	        // acquire the username of each comment
	        $results[$i]['Username'] = $avatar['Username'];
	  }

      $response = json_encode($results);

       print($response);
      break;

	case "usernameTest":
		$stmt = $conn->prepare("SELECT * FROM `members` WHERE `Username` = ?");
		$stmt->execute(array($_GET['username']));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		print empty($result) ? 0 : 1;
		break;

	case "emailTest":
		$stmt = $conn->prepare("SELECT * FROM `members` WHERE `Email` = ?");
		$stmt->execute(array($_GET['email']));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		print empty($result) ? 0 : 1;
		break;

    default:
      print("improper usage!");
      break;
  }

?>
