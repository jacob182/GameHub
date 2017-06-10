<?php
	session_start();
	if(isset($_POST['submit'])) {
		if(!empty($_POST['email']) && !empty($_POST['message'])) {
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$to      = 'jacobcoorey@gmail.com';
				$subject = $_POST['email'];
				$message = $_POST['message'];
				$headers = 'From: ' . $_POST['email'] . "\r\n" .
					'Reply-To: ' . $_POST['email'] . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				$_SESSION['emailError'] = '';
				$_SESSION['emailSuccess'] = "Email has been sent";
			} else {
				$_SESSION['emailError'] = 'You must enter a valid email address!';
			}
		} else {
			$_SESSION['emailError'] = 'Both fields are required!';
		}
	}

	header('location: ../view/feed.php');

?>
