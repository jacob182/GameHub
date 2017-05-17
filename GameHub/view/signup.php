<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "Signup";

	//retrieve the header
	require('header.php');
?>

<h1>Sign Up</h1>
<div class="login-container">

  <div id="login">
    <form action="../controller/registration_process.php" method="post">

      <div class="field-wrap">
        <label> Username*</label>
        <input type="text" id="username" name="username" placeholder="Enter username"/>
      </div>

      <div class="field-wrap">
        <label>Email Address*</label>
        <input type="email" id="email" name="email" placeholder="Enter your email*" required/>
      </div>

			<div class="field-wrap">
				<label>Confirm Email Address*</label>
				<input type="email" id="confirm-email" name="confirm-email" placeholder="Enter your email*" required/>
			</div>

      <div class="field-wrap">
        <label>Password*</label>
        <input type="password" id="password" name="password" placeholder="Enter your password*" required pattern=".{7,}"/>
      </div>

			<div class="field-wrap">
        <label>Confirm Password*</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password*" required pattern=".{7,}"/>
      </div>

      <button class="signupbtn" name="register"/>Sign Up</button>

    </form>

  </div>
</div>
<?php
if(isset($_SESSION['error']))
	print($_SESSION['error']);

elseif(isset($_SESSION['success']))
	print($_SESSION['success']);
 ?>
<?php
  //retrieve the footer
  require('footer.php');
?>
