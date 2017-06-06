<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "Login";

	//retrieve the header
	require('header.php');
?>

<div class="adminwrapper block">
<?php
	if(!isLogged() || !admin()) header ('location:feed.php');

	global $conn;
	if(isset($_GET['username'])) {
		$stmt = $conn->prepare("SELECT * FROM `members` WHERE `username` = ?");
		$stmt->execute(array($_GET['username']));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if(isset($_POST['submit'])) {
			$stmt = $conn->prepare("UPDATE `members` SET `admin` = ? WHERE `Username` = ?");
			$stmt->execute(array($_POST['rank'], $_GET['username']));
			print("You have successfully updated this user's rank!");
		}

		print("<h3>Edit {$user['Username']}'s Rank</h3>");
		print("
		<form method='POST'>
			<select name='rank'>
				<option value='0'>Banned</option>
				<option value='1'>User</option>
				<option value='2'>Administrator</option>
			</select>
			<input name='submit' type='submit' value='Update Rank' />
		</form>");
	}

	$stmt = $conn->prepare("SELECT * FROM `members`");
	$stmt->execute();

	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach($users as $user) {
		print("<div class='follow-display auto	'>
						<p class='bold'>User:	</p> <p>{$user['Username']}</p> <p class='bold'>Rank:</p> <p>{$user['Admin']}</p><br/>");
		print("<a class='editrank' href='admin.php?username={$user['Username']}'>Edit rank</a><br/>
						</div>");
	}
?>


</div>

<?php
//retrieve the footer
require('footer.php');
?>
