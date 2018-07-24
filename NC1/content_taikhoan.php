<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="NC1/inbox.css">
    <link rel="shortcut icon" href="NC1/tel4vn.png">
    <title>Account info recharge</title>
    <style rel="stylesheet">
	.acc{
	   clear:both;
	   text-align:right;
	}
    </style>
  </head>
  <body>
    <div style="margin-top:10px;">
    <?php
        include_once "DBConnect.php";
        if(!isset($_SESSION)){
            session_start();
            //session_destroy();
        }
        if(isset($_SESSION['admin'])){
            echo '<div class="acc">'."Welcome "."<a href='trang-quan-tri.html'>"."admin"."</a></div>";
        }
        else{
            header("Location: index.php");
            exit;
        }
    ?>
        <div id="header" id="menu">
        <nav class="navbar navbar-inverse" style="padding: 5px 20px;">
            <div class="navbar-header" style="margin-right:20px;margin-left:20px;">
                <a href="trang-quan-tri.html"><img src="NC1/NC_Telecom.png" class="img-circle" alt="NC_Telecom" width="50" height="50"></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <i class="glyphicon glyphicon-user" style="float:left;background-color:white;margin:15px 0px 10px 10px;"></i>
                    <li><a href="trang-quan-tri.html" style="color: white">Add user</a></li>
                    <i class="glyphicon glyphicon-list-alt" style="float:left;background-color:white;margin:15px 0px 10px 10px;"></i>
                    <li><a href="quan-ly.html" style="color: white">Manage</a></li>
                    <i class="glyphicon glyphicon-usd" style="float:left;background-color:white;margin:15px 5px 0px 10px;"></i>
                    <li><a href="them-tien.html" style="color: white">Add furd</a></li>
                    <li><a href="xu-ly-bao-cao-chuyen-tien.html" style="color: white">Transfer Report</a></li>
                    <li><a href="check.html" style="color: white">Send SMS</a></li>
                    <li><a href="tin-nhan-tai-khoan-nap-tien.html" style="color: white">Info recharge</a></li>
                    <i class="glyphicon glyphicon-th" style="float:left;background-color:white;margin:15px 5px 0px 10px;"></i>
                    <li class="dropdown">
                        
                        <a data-toggle="dropdown" href="" style="color: white">Report<span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:black;background-color:black">
                            <li><a href="bao-cao-nguoi-dung.html" style="color: white;background-color:black">Users</a></li>
                            <li><a href="bao-cao-he-thong.html" style="color: white;background-color:black">Systems</a></li>
                            <li><a href="bao-cao-tin-nhan.html" style="color: white;background-color:black">SMS</a></li>
                            <li><a href="bao-cao-tai-chinh.html" style="color: white;background-color:black">Final</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!--<div style="border:1px solid">-->
    <table class="table table-striped" style="text-align: center;" border="1">
      <thead style="font-weight:bold; background-color: #1ab188;">
            <tr>
                <th width="10%" style="text-align: center;">Port</th>
                <th width="20%" style="text-align: center;">Number</th>
                <th width="30%" style="text-align: center;">Time</th>
                <th width="40%" style="text-align: center;">Content</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // PH?N HI?N TH? TIN NH?N Ð?N
        // curl -u admin:TEL4VN.COM  -H "Content-Type: application/json" http://14.169.209.75/api/query_incoming_sms?flag=all
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
        curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/query_incoming_sms?port=10,flag=all");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_USERPWD, "admin" . ":" . "TEL4VN.COM");

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        $pattern = array('/VIETTELKM/', '/KMNAPTHE/', '/VIETTELQC/', '/VIETTELDV/');
        $replace = array('VIETTEL KM', 'KM NAPTHE', 'VIETTEL QC', 'VIETTEL DV');
        $temp = json_decode( preg_replace($pattern, $replace, $result), true );
        //echo "<pre>";print_r($result);echo "</pre>";exit;
        //echo $temp;exit;
        // INSERT VÀO DB
        /******************************************************************
         * V?N Ð? ? CH? LÀ LÀM SAO CH? INSERT 1 L?N, Ð? KHI KH RELOAD     *
         * TRANG ÐÓ L?I THÌ S? KHÔNG B? GHI TRÙNG DB                      *
         * ****************************************************************/
         if(isset($temp['sms']) == 0){
               return;
         }
         else {
             for($i = 0; $i < count($temp['sms']); $i++){
                $port = $temp['sms'][$i]['port'];
                $number = $temp['sms'][$i]["number"];
                $timestamp = $temp['sms'][$i]["timestamp"];
                $content = $temp['sms'][$i]["text"];
                $sql1 = "SELECT * FROM `nghia_nhantin`.`inbox` 
                         WHERE  port = '10' 
                         AND number = '$number' 
                         AND datetime = '$timestamp'
                         AND content = '$content'";
                $conn1 = mysqli_query($con, $sql1);
                if(mysqli_num_rows($conn1) > 0)
                {
                    return;
                }
                else{
                    $sql = "INSERT IGNORE INTO `nghia_nhantin`.`inbox`(port, number, datetime, content)
                            VALUES ('$port', '$number', '$timestamp', '$content')";
                    mysqli_query($con, $sql);
                }
            }
         }
        
?>

            <?php
                $sql = "SELECT * FROM `nghia_nhantin`.`inbox` WHERE port = 10 AND number = '+84976764205' ORDER BY id ASC";
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
            ?>
                  <tr class="productInfo-<?= $row['id']?>">
                      <td>
                          <?= $row['port'];?>
                      </td>
                      <td>
                          <?= $row['number']?>
                      </td>
                      <td>
                          <?= $row['datetime']?>
                      </td>
                      <td>
                          <?= $row['content']?>
                      </td>
                  </tr>
                <?php endwhile?>
              <?php endif?>
        </tbody>
    </table>
    </div>
    </div>
  </body>
</html>
