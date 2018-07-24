<?php
  include "DBConnect.php";

  $id = $_POST['id'];
  
  // Delete record
  $query = "DELETE FROM users WHERE id=".$id;
  mysqli_query($con,$query);
  
  echo 1;
?>