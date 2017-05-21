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

	<form method="post" action="../controller/new_avatar_process.php" class="field-wrap-avatar" enctype="multipart/form-data">
		<label class="edit-profile-heading">Change Avatar</label></br>
		<span class="settings-avatar-box">
		<?php if($result['ClientImage']) {?>
				<img src="<?php echo $result['ClientImage']?>" alt="" class="settings-avatar">
		<?php } else { ?>
				<img src="../images/default.jpg" alt="" class="settings-avatar">
		<?php } ?>
		</span>
		<input type="file" accept="image/*" name="client_image"/>
		<button class="choose-file" type="file" class="upload-avatar" name="upload_avatar">Upload Avatar </button>
	</form>

	<form action="../controller/edit_profile_process.php" method="post" class="edit-profile-container">

		<div class="field-wrap">
			<label class="edit-profile-heading">Username</label></br>
			<span class="edit-username">Link182</span>
			<input type="hidden" name="username" value="<?php echo $_SESSION['user'] ?>" />
		</div>

		<div class="field-wrap">
			<label class="edit-profile-heading" for="edit-email">Email</label>
		   <input class="edit-input" id="edit-email" name="email" type="text" value="<?php echo $result['Email'] ?>"/>
		</div>
		<div class="field-wrap">
		  <label class="edit-profile-heading">Password</label>
			<button class="newpasswordbtn" id="editPasswordbtn" onclick="return edit_password()">Edit Password</button>
		</div>

		<div id="edit-password">
			<div class="field-wrap">
			  <label class="edit-profile-heading">Current Password</label>
				<input id="old-password" name="oldPassword" type="text"/>
			</div>
			<div class="field-wrap">
			  <label class="edit-profile-heading">New Password</label>
				<input  id="password" name="newPassword" type="password"/>
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
