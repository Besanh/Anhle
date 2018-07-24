<?php
    include "DBConnect.php";
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    // Delete record
    $query = "UPDATE `users` SET `fund_add`= fund_add + '$quantity' WHERE id=".$id;
    mysqli_query($con,$query);
    $query1 = "update users set fund_result = fund_result + fund_add where id =".$id;
    mysqli_query($con, $query1);
    //$_SESSION['message'] = "Added to $id successfully";
    header("Location: them-tien.html");
?>