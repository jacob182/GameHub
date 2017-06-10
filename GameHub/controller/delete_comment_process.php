<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    require('../model/function_videos.php');
?>

<?php
    $commentID = $_GET['commentID'];

    $result = delete_comment($commentID);

    if($result){
        header('location:../view/feed.php');
    }else{
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        header('location:../view/feed.php');
    }
?>
