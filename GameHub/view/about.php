<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "About Us";

	//retrieve the header
	require('header.php');
?>
<div class="wrapper block">
  <div id="slides">
    <img class="imageSlides" src="..\images\CSGO_slide.png"
    style="width:100%">
    <img class="imageSlides" src="..\images\League_slide.png"
    style="width:100%">
    <img class="imageSlides" src="..\images\overwatch_slide.jpg"
    style="width:100%">
  </div>
  <div class="about-content">
    <h1>About Us</h1>
  </div>
</div>
<div class="wrapper block">
	<div id="aboutToggle">Click here to discover what we're about.</div>
	<div id="about">
		<div class="about-box">
			<h2>Purpose</h2>
			<p>Our very basic purpose is to allow users to share videos with other users with ease, <strong>BANTZ Community</strong> exclusive currently.</p></br>
			<p>Those who use this site for the wrong purpose and make the others uncomfortable will be <strong>B A N N E D</strong> with no questions asked.</p>
	 	</div>

		<div class="about-box">
					<h2>Bantz</h2>
					<p>Quisque vitae felis eros. Suspendisse quis leo molestie, iaculis sapien id, hendrerit augue. Phasellus fermentum.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Ut enim ad minim veniam, quis nostrud exercitation.</p>
		 </div>

		 <div class="about-box">
					<h2>Rules</h2>
					<p>Vivamus non scelerisque ex, et interdum leo. In bibendum lacus vitae felis egestas, at consectetur metus facilisis.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Ut enim ad minim veniam, quis nostrud exercitation.</p>
		 </div>
	 </div>
</div>
  <?php
    //retrieve the footer
    require('footer.php');
  ?>
