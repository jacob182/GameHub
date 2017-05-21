<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "Profile";

	//retrieve the header
	require('header.php');


?>

<div class="profile-header">

	<div class="profile-stats">
		<ul>
			<li>13    <span>Videos</span></li>
			<li>1,354 <span>Followers</span></li>
			<li>32    <span>Following</span></li>
		</ul>
	</div>
	<div class="profile-picture-container">
		<a href="edit_profile.php"><figure class="profile-picture" style="background-image: url('../images/profile_images/test.jpg')"></figure></a>
	</div>

	<h1><?php echo $_SESSION['user'] ?></h1>
<button class="editbtn" onclick="location.href='edit_profile.php';">Edit Profile </button>

</div>

<div class="wrapper">
	<form class="upload-form" action="../controller/upload_process.php" method="post" enctype="multipart/form-data">
			<input class="choose-file" type="file" name="file"/>
			<label>Video Description	</label><textarea class="vid-description" type="text" name="vid-description"></textarea>
			<input class="submit-file" type="submit" name="submit_file" value="upload"/>
	</form>
</div>
  <?php
    //retrieve the footer
    require('footer.php');
  ?>
