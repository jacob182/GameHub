<?php
    //start session management
    session_start();
    //provide the value of the $title variable for this page
    $title = "feed";

    //retrieve the header
    require('header.php');
?>
<div class="wrapper">
  <div class="profile">
        <?php
        if(isLogged()) {
            print('<div class="profile-box">
          <div class="username-wrapper">
            <div id="user-avatar">
              <img src="../images/profile_images/test.jpg" alt="avatar" width="100%" height="100%">
            </div>
                    <a class="username" href="">' . $_SESSION['user'] . '</a>
          </div>

          <div class="user-stats">
            <div>
              <div>Videos</div></br>
              <div>#</div>
            </div>
            <div>
              <div>Followers</div></br>
              <div>#</div>
                    </div>
            <div>
                        <div>Followed</div></br>
              <div>#</div>
            </div>
                </div>
            </div>');
        } else {
            print("<div class='signup-box'>
                            <h3> Welcome</br> Please login</h3>
                            <button class='profile-login'><a href='login.php'>Login</a></button>
                            </div>");
        }
        ?>

    </div>

  <div class ="feed">
        <?php
        global $conn;
        $sql = 'SELECT * FROM videos ORDER BY Date_added';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        foreach ($result as $item){
                        echo '<div class="feed-item">
                                 <div class="feed-video">
                                     <video src="../' . $item['Vid_url'] . '" width="100%" controls></video>
                                 </div>
                                <div class="feed-description">
                                        <a class="author-avatar" href=""><img class="avatar" src="../images/profile_images/test.jpg" alt="Author Image"></a>
                                        <p><a class="author-name" href="">' . $item['Username'] . '</a>' . $item['Vid_description'] . '</p>
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
              <a class="author-avatar" href=""><img class="avatar comment-avatar" src="../images/profile_images/test.jpg" alt="Author Image"></a>
              <p><a class="author-name" href="">' . $item['Username'] . '</a>' . $item['Comment_txt'] . '</p>
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
         ?>
     </div>

  </div>

        <?php
        //retrieve the footer
        require('footer.php');
    ?>
