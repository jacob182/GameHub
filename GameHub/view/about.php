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
<div class="wrapper">
				<div class="">
						 <div class="">
									<h2>First Title</h2>
									<p>Integer eget tortor justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit <strong>Ut enim ad minim veniam, quis nostrud</strong> exercitation ullamco.</p>
						 </div>

						 <div class="">
									<h2>Second Title</h2>
									<p>Quisque vitae felis eros. Suspendisse quis leo molestie, iaculis sapien id, hendrerit augue. Phasellus fermentum.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Ut enim ad minim veniam, quis nostrud exercitation.</p>
						 </div>

						 <div class="">
									<h2>Third Title</h2>
									<p>Vivamus non scelerisque ex, et interdum leo. In bibendum lacus vitae felis egestas, at consectetur metus facilisis.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Ut enim ad minim veniam, quis nostrud exercitation.</p>
						 </div>

						 <div class="">
									<h3>Fully Customizable!</h3>
									<p>Maecenas quis pulvinar neque, non dapibus orci. Integer non suscipit dui. In eu tempor sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras porta lacus ac sagittis imperdiet. Vestibulum eget mattis quam.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita.</p>
						 </div>

						 <div class="">
									<h3>Section One</h3>
									<p>Pellentesque lobortis velit mi, sed volutpat enim facilisis at. Maecenas quis pulvinar neque, non dapibus orci.</p>
						 </div>

						 <div class="">
									<h3>Section Two</h3>
									<p>Pellentesque lobortis velit mi, sed volutpat enim facilisis at. Maecenas quis pulvinar neque, non dapibus orci.</p>
						 </div>

						 <div class="">
									<h3>Section Three</h3>
									<p>Pellentesque lobortis velit mi, sed volutpat enim facilisis at. Maecenas quis pulvinar neque, non dapibus orci.</p>
						 </div>

				</div>
</div>
  <?php
    //retrieve the footer
    require('footer.php');
  ?>
