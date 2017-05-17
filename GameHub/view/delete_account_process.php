<?php
session_start();
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/function_members.php');

if(isset($_POST['delete'])) {
  delete_profile();
}
header('location: feed.php');
 ?>
