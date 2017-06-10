<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "About Us";

	//retrieve the header
	require('header.php');
?>
<div class="wrapper njc">
<p>Probs not what you're looking for try clicking <a class="bold" href="feed.php">here.</a></p>
</div>
<?php
  //retrieve the footer
  require('footer.php');
?>
