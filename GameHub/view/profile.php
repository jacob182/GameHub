<?php
	//start session management
	session_start();

	//provide the value of the $title variable for this page
	$title = "Profile";

	//retrieve the header
	require('header.php');
	if (!isLogged ()) header ('location: login.php');
	//check if user is logged in/set variables for user data
	if(isset($_GET['username'])) {
		$username = $_GET['username'];
	} else {
		$username = $_SESSION['user'];
	}

	//redirect if user does not exist
	if(!get_member($username)) {
		header('location:feed.php');

	}

	//Grab user information
	$user = get_member($username);

	global $conn;
	$stmt = $conn->prepare("SELECT count(*) FROM `videos` WHERE `Username` = ?");
	$stmt->execute(array($username));
	$vidCount = $stmt->fetch();
	$vidCount = $vidCount['count(*)'];

	//Generate the follow/unfollow link based on if the user has followed the profile
	if(isLogged() && $username != $_SESSION['user']) {
		$stmt = $conn->prepare("SELECT * FROM `followers` WHERE `followerID` = ? AND `followingID` = ?");
		$stmt->execute(array($_SESSION['user'], $username));
		$check = $stmt->fetch();
		if(!empty($check)) {
			$followTxt = "<li><a class='follow' href='../controller/follow_process.php?username={$username}'>Unfollow</a></li>";
		} else {
			$followTxt = "<li><a class='follow' href='../controller/follow_process.php?username={$username}'>Follow</a></li>";
		}
	}

?>

<div class="profile-header">

	<div class="profile-stats">
		<ul>
			<li><?php print($vidCount) ?>    <span>Videos</span></li>
			<li><?php print($user['followers']) ?> 	<a href="/follower" id="followers" class="follow"><span>Followers</span></a></li>
			<li><?php print($user['following']) ?>  <a href="/following" id="following" class="follow"><span>Following</span></a></li>
			<?php
			if($username != $_SESSION['user']) {
				print($followTxt);
			} ?>
		</ul>
	</div>
	<div class="profile-picture-container">
		<a href="edit_profile.php"><figure class="profile-picture" style="background-image: url('<?php print get_avatar($username); ?>')"></figure></a>
	</div>

	<h1><?php echo $username ?></h1>
	<?php
		//check if user is currently viewing their own profile
		if(isLogged()) {
			if($username == $_SESSION['user']) {
				print('<button class="editbtn" onclick="location.href=\'edit_profile.php\';">Edit Profile </button>');
			}
		}
	?>


</div>
<div class="viderror">
	<?php
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		print($_SESSION['error']);
		$_SESSION['error'] = '';
	}
	?>
</div>
<div class="wrapper">
	<div class="followerspop fspop">
	<?php
		$stmt = $conn->prepare("select * from `followers` WHERE `followingID` = ?");
		$stmt->execute(array($username));
		$followers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($followers as $follower) {
			print('	<div class="follow-display">
								<a class="author-avatar"> <img class="follow-avatar" src="' . get_avatar($follower['followerID']) . '" alt="Author Image"></a>');
								echo" <a class='author-name'> {$follower["followerID"]} </a><br />
							</div>";
		}
	?>

    <!-- Add an optional button to close the popup -->
		<div class="block">
    	<button class="close" href="/">close</button></p>
		</div>

  </div>
	<div class="followedpop fdpop">
	<?php
		$stmt = $conn->prepare("select * from `followers` WHERE `followerID` = '$username'");
		$stmt->execute(array($username));
		$followers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($followers as $follower) {
			print('	<div class="follow-display">
								<a class="author-avatar"> <img class="follow-avatar" src="' . get_avatar($follower['followerID']) . '" alt="Author Image"></a>');
								echo" <a class='author-name'> {$follower["followeingID"]} </a><br />
							</div>";
	?>

    <!-- Add an optional button to close the popup -->
		<div class="block">
    	<button class="close" href="/">close</button></p>
		</div>

  </div>
	<?php

	//check if user is currently viewing their own profile
		if(isLogged()) {
			if($username == $_SESSION['user']) {
				print('<form class="upload-form" action="../controller/upload_process.php" method="post" enctype="multipart/form-data">
						<input class="choose-file" type="file" name="file"/>
						<label>Video Description	</label><textarea class="vid-description" type="text" name="vid-description"></textarea>
						<input class="submit-file" type="submit" name="submit_file" value="upload"/>
				</form>');
			}
		}

		global $conn;
		$stmt = $conn->prepare("SELECT * FROM `videos` WHERE `Username` = ? ORDER BY Date_added DESC LIMIT 5 ");
		$stmt->execute(array($username));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		print('</div><div class="profile-feed" style="margin:0 auto;">');
		foreach ($result as $item){
                        echo '<div class="feed-item">
                                 <div class="feed-video">
                                     <video src="../' . $item['Vid_url'] . '" width="100%" controls></video>
                                 </div>
																 <div class="feed-description">
	 				                          <a class="author-avatar" href="../view/profile.php?username=' . $item['Username'] . '"><img class="avatar" src="' . get_avatar($item['Username']) . '" alt="Author Image"></a>
	 				                          <p class="mt9"><a class="author-name" href="../view/profile.php?username=' . $item['Username'] . '">' . $item['Username'] . '</a>' . $item['Vid_description'] . '</p>';
			                                    if(isLogged()){
			                                      if($item['Username'] == $_SESSION['user']) {
			                                        ?>
			                                        <a href="../controller/delete_video_process.php?vidID=<?php echo $item["Vid_ID"]; ?>" onclick="return confirm('Are you sure you want to delete this video?')">
			                                          <button class="delete-video">Delete Video</button>
			                                        </a>
			                                        <?php }
			                                    } echo '
                                     </div>
                             	</div>';

												echo "<div id='comments_{$item['Vid_ID']}'>";

        global $conn;
        $sql = 'SELECT * FROM comments WHERE comments.Vid_ID = :id ORDER BY comments.Date_added LIMIT 0,2';
        $statement = $conn->prepare($sql);
        $statement->bindValue(':id', $item['Vid_ID']);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $commentCount = intVal(get_comment_count($item['Vid_ID'])['commentCount']);

          foreach ($result as $item) {
						echo '<div class="comment-list">
	            <div class="comment-entry">
	              <a class="author-avatar" href=""><img class="avatar comment-avatar" src="' . get_avatar($item['Username']) . '" alt="Author Image"></a>
	              <p class="mt4"><a class="author-name" href="">' . $item['Username'] . '</a>' . $item['Comment_txt'] . '</p>
	              ';
              if(isLogged()){
                if($item['Username'] == $_SESSION['user']) {
                  ?>
                  <a href="../controller/delete_comment_process.php?commentID=<?php echo $item["Comment_ID"]; ?>" onclick="return confirm('Are you sure you want to delete this comment?')">
                    <button class="delete-comment">X</button>
                  </a>
                  <?php }
              }
          echo'
            </div>
          </div>';
          }

          if($commentCount > 2) {
                      echo '<div class="more-comments">
                              <a onClick="showComments(' . $item['Vid_ID'] . ')"> Show All Comments </a>
                            </div>';
                    }

              echo' </div>';

          if(isLogged()) {
              echo'<form class="comment-form" action="../controller/comment_process.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="Vid_ID"  value=' . $item['Vid_ID'] . ' />
                <input class="vid-description" placeholder="Write a comment..." type="text" name="comment_txt" required/>
                <input class="comment-submit" type="submit" name="post_comment" value="Comment"/>
              </form>';
         }
    }
	print('</div>');

?>


</div>
  <?php
    //retrieve the footer
    require('footer.php');
  ?>
