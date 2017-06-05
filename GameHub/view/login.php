<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "Login";

	//retrieve the header
	require('header.php');
?>
<h1>Log In</h1>
<div class="login-container">

  <div id="login">
    <form action="../controller/login_process.php" method="post">
			<?php
				if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
					print($_SESSION['error']);
					$_SESSION['error'] = '';
				} else if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
					print($_SESSION['success']);
					$_SESSION['success'] = '';
				}
			?>
			<div id="errorAnchor"></div>
      <div class="field-wrap">
        <label>Username*</label>
        <input type="text" name="username" id="username" placeholder="Enter your username*"/>
      </div>
      <div class="field-wrap">
        <label>Password*</label>
        <input type="password" name="password" id="password" placeholder="Enter your password*" required/>
      </div>
      <button class="loginbtn"/>Log In</button>
    </form>
		<a class="redirect" href='signup.php'>Not registered? Signup Now!</a>
  </div>
</div>

<?php
  //retrieve the footer
  require('footer.php');
?>
