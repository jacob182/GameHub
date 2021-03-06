<html>
  <head>
    <title><?php
	//Display errors for development environment
	ini_set('display_errors',1);
	error_reporting(E_ALL);

  $load_start = microtime();
	echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <noscript>
      <META HTTP-EQUIV="Refresh" CONTENT="0;URL=ShowErrorPage.php">
    </noscript>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.2.6/gridstack.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.2.6/gridstack.min.css" />
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
            <li><a href="feed.php">Discover</a></li> -
            <?php
            if(isLogged()) {
              print("<li><a href='your_feed.php'>Your Feed</a></li> -");
            } else {
            }
            ?>

            <?php
            if(isLogged()) {
              print("<li><a href='profile.php'>Profile</a></li>");
            } else {
            }
            ?>
            <li><a href="about.php">About</a></li>
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
