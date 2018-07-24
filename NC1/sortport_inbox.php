<?php
    include "DBConnect.php";
    $port = $_POST['port'];
    $sql = "SELECT * FROM `inbox` WHERE port = $port";
    mysqli_query($con,$query);
  
    echo 1;
?>