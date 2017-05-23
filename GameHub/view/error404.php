<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "About Us";

	//retrieve the header
	require('header.php');
?>

yeah nah this isnt a thing yet
<div class="wrapper">
	<div class="follow-display">
		<a class="author-avatar"><img class="follow-avatar" src="../images/profile_images/test.jpg" alt="Author Image"></a>
		<p><a class="author-name">USERNAME HERE </a> </p>
	</div>
</div>
<?php
  //retrieve the footer
  require('footer.php');
?>
