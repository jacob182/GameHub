<?php
	//start session management
	session_start();
	//provide the value of the $title variable for this page
	$title = "Profile Edit";
	require('../model/database.php');
	require('header.php');
	$result = get_member($_SESSION['user']);

?>
<h1> Edit Profile </h1>
<div class="wrapper">
	<form action="../controller/edit_profile_process.php" method="post" class="edit-profile-container">
		<div class="field-wrap">
			<label class="edit-profile-heading">Username</label></br>
			<span class="edit-username">Link182</span>
			<input type="hidden" name="username" value="<?php echo $_SESSION['user'] ?>" />
		</div>

		<div class="field-wrap">
			<label class="edit-profile-heading" for="edit-email">Email</label>
		   <input class="edit-input" id="edit-email" name="email" type="text" value="<?php echo $result['Email'] ?>">
		</div>
		<div class="field-wrap">
		  <label class="edit-profile-heading">Password</label>
			<button class="newpasswordbtn" id="editPasswordbtn" onclick="return edit_password()">Edit Password</button>
		</div>
		<div id="edit-password">
			<div class="field-wrap">
			  <label class="edit-profile-heading">Current Password</label>
				<input id="old-password" name="oldPassword" type="text">
			</div>
			<div class="field-wrap">
			  <label class="edit-profile-heading">New Password</label>
				<input  id="password" name="newPassword" type="password">
			</div>
			<div class="field-wrap">
			  <label class="edit-profile-heading">Confirm New Password</label>
				<input  id="confirm-new-password" name="confirmNewPassword" type="password">
			</div>
		</div>
	<div style="clear:both"></div>
		<input type="submit" class="profilebtn" value="Save Changes" />
	</form>
	<form class="delete-account" method="POST" action="delete_account_process.php">
		<input class="profilebtn" type="submit" onclick="confirm('Are you sure you want to delete your account?');" name="delete" value="Delete Account"/>
	</form>
</div>
<?php
	//retrieve the footer
	require('footer.php');
?>
