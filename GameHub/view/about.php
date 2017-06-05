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
    <img class="imageSlides" src="..\images\CSGO_slide.png" style="width:100%">
    <img class="imageSlides" src="..\images\League_slide.png" style="width:100%">
    <img class="imageSlides" src="..\images\overwatch_slide.jpg" style="width:100%">
  </div>
</div>
<div class="about-content">
	<h1>About Me</h1>
</div>
<div class="block wrapper">
	<div class="about-box">
		<h2>Where can you find me?</h2>
		<p>My in game name is <strong>Link182</strong> and you can see my stats, match history and other information at: <a class="redirect" href="https://oce.op.gg/summoner/userName=link182">Link182</a></p>
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
			<h2>Bantz Gaming Community</h2>
			<p>Pretty toxic environment to be honest, few gems in the bunch but you find some so so people.</p>
			<p>This is not the Bantz community. This is a place of piece, keep it that way.</p>
		</div>

		<div class="about-box">
			<h2>Rules</h2>
			<p>Rules?</p>
			<p>Don't break my site lul.</p>
		 </div>
	 </div>

	 <div id="meToggle">Click here to see Link182 himself.</div>
	 <div id="aboutme">
		 <div class="about-box">
 			<h2>Link182</h2>
 			<img class="challenger" src="..\images\challenger.png">
 			<p>Basically challenger so if you think otherwise... <strong>B A N N E D.</strong> No questions asked.</p>
 	 	</div>
	 </div>


</div>
  <?php
    //retrieve the footer
    require('footer.php');
  ?>
