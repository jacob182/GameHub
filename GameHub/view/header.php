<html>
  <head>
    <title><?php
	//Display errors for development environment
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--  <noscript>
          <META HTTP-EQUIV="Refresh" CONTENT="0;URL=ShowErrorPage.php">
        </noscript>
  -->
    <script type="text/javascript" src="../js/scripts.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>

    <?php
      require ('../model/database.php');
      require('../model/function_members.php');
      require('../model/function_videos.php');
    ?>
    <nav>
      <div class="wrapper">
        <div class="left">
          <a href="feed.php" id='logo'>
            <img src="../images/logo.png" alt="Game Hub" width="150" height="40" />
          </a>
          <ul>
            <li><a href="feed.php">Video Feed</a></li>
            <li><a href="#">Followed</a></li>
            <?php
            if(isLogged()) {
              print("<li><a href='profile.php'>Profile</a></li>");
            } else {
              print("<li><a href='login.php'>Profile</a></li>");
            }
            ?>
            <li><a href="about.php">About Us</a></li>
          </ul>
          <div id="clear"></div>
        </div>



        <div class="right">
          <ul>
              <?php
              if(isLogged()) {
                print("<li id='signup'><a href='signout.php'>Sign out</a></li>");
              } else {
                print("<li><a href='login.php'>Login</a></li><li id='signup'><a href='signup.php'>Sign up</a></li>");
              }
              ?>
          </ul>
        </div>
      </div>
    </nav>
