<?php
    include_once "DBConnect.php";
    $port = $_POST['check'];echo $port;
    $arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
    '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', 
    '20', '21', '22', '23', '24', '25', '26', '27'];
    for($i = 0; $i < count($port); $i++){
        for($j = 0; $j< count($arr); $j++){
          if($port[$i] == $j){
            $p = $port[$i];
            $sql = "SELECT * FROM `inbox` WHERE port = $p";
            $c = mysqli_query($con, $sql);
            $r = mysqli_num_rows($c);
            echo $r['port'];
            echo $r['content'];
          }
        }
    }
?>