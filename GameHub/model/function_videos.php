<?php

// in function_videos.php
function delete_comment($commentID)
{
  //establishing the connection to the database
  global $conn;
  //sql value is set to delete product information and connecting values
  $sql = "DELETE FROM comments WHERE Comment_ID = :commentID";
  //preparing for sql query
  $statement = $conn->prepare($sql);
  //value linked to the correct variable
  $statement->bindValue(':commentID', $commentID);
  //result set and executed
  $result = $statement->execute();
  //some drivers require this function to create an efficient connection to the server
  $statement->closeCursor();
  //result is returned to the database
  return $result;
}

function get_comment_count($vidID)
{
  global $conn;
  //sql value is set to delete product information and connecting values
  $sql = "SELECT COUNT(*) as commentCount FROM comments WHERE comments.Vid_ID = :vidID";
  //preparing for sql query
  $statement = $conn->prepare($sql);
  //value linked to the correct variable
  $statement->bindValue(':vidID', $vidID);
  //result set and executed
  $statement->execute();
  $result = $statement->fetch();
  //some drivers require this function to create an efficient connection to the server
  $statement->closeCursor();
  //result is returned to the database
  return $result;
}
 ?>
