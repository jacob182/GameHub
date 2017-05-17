<?php
	session_start();
  if(!isset($_GET['action'])) die('Cannot directly access this file!');
  switch($_GET['action']) {
    case "comments":
      if(!isset($_GET['Vid_ID'])) die('Improper usage!');
      include('../model/database.php');
      include('../model/function_members.php');
      global $conn;
      $stmt = $conn->prepare("SELECT * FROM `comments` WHERE `Vid_ID` = ? ORDER BY `Date_added`");
      $stmt->execute(array($_GET['Vid_ID']));

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //Differentiate comments from commented created by logged in user in order to display moderation links
	  for($i = 0; $i < count($results); $i++) {
		  $results[$i]['owned'] = 0;
		  if(isLogged()) {
        if($_SESSION['user'] == $results[$i]['Username']) {
				  $results[$i]['owned'] = 1;
			  }
		  }
	  }

      $response = json_encode($results);

       print($response);
      break;

    default:
      print("improper usage!");
      break;
  }

?>
