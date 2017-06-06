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
    <form action="../controller/registration_process.php" method="post" onsubmit="return register();" novalidate>
		<?php
			if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
				print($_SESSION['error']);
				$_SESSION['error'] = '';
			} else if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
				print($_SESSION['sccess']);
				$_SESSION['success'] = '';
			}
		?>
		<div id="errorAnchor"></div>
      <div class="field-wrap">
        <label> Username*</label>
        <input onfocusout="checkusername()" type="text" id="username" class="input" name="username" placeholder="Enter username" required/>
				<p id="usernamenotification" class="help is-danger"></p>
      </div>

      <div class="field-wrap">
        <label>Email Address*</label>
        <input onfocusout="checkemail()" type="email" id="email" class="input" name="email" placeholder="Enter your email*" required/>
				<p id="emailnotification" class="help is-danger"></p>
      </div>

      <div class="field-wrap">
        <label>Password*</label>
        <input type="password" id="password" name="password" placeholder="Enter your password*" required pattern=".{7,}"/>
      </div>

			<div class="field-wrap">
        <label>Confirm Password*</label>
        <input onfocusout="checkpassword()" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password*" required pattern=".{7,}"/>
				<p id="passwordnotification" class="help is-danger"></p>
      </div>

      <button id="regbtn" class="signupbtn" disabled/>Sign Up</button>

    </form>
		<a class="redirect" href='login.php'>Already registered? Login Now!</a>
  </div>
</div>
<?php
  //retrieve the footer
  require('footer.php');
?>
