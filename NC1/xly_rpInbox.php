<?php
    include_once "DBConnect.php";
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION['admin'])){
         header("Location: index.php");
         exit;
    }
    else{
        // PH?N HI?N TH? TIN NH?N ??N
        // curl -u admin:TEL4VN.COM  -H "Content-Type: application/json" http://14.169.209.75/api/query_incoming_sms?port=11,flag=read
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
        curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/query_incoming_sms?flag=all");
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
        // INSERT V?O DB
        /******************************************************************
         * V?N ?? ? CH? L? L?M SAO CH? INSERT 1 L?N, ?? KHI KH RELOAD     *
         * TRANG ?? L?I TH? S? KH?NG B? GHI TR?NG DB                      *
         * ****************************************************************/
        for($i = 0; $i < count($temp['sms']); $i++){
            $port = $temp['sms'][$i]['port'];
            $number = $temp['sms'][$i]["number"];
            $time = $temp['sms'][$i]["timestamp"];
            $content = $temp['sms'][$i]["text"];
            $sql1 = "SELECT * FROM `nghia_nhantin`.`rp_inbox` 
                     WHERE  port = '$port' 
                     AND number = '$number' 
                     AND time = '$timestamp'
                     AND content = '$content'";
            $conn1 = mysqli_query($con, $sql1);
            if(mysqli_num_rows($conn1) > 0)
            {
                header("Location: bao-cao-tin-nhan-da-nhan.html");	
            }
            else{
                $sql = "INSERT IGNORE INTO `nghia_nhantin`.`rp_inbox`(port, number, time, content)
                        VALUES ('$port', '$number', '$time', '$content') WHERE port='10'";
                mysqli_query($con, $sql);
            }
        }
        header("Location: bao-cao-tin-nhan-da-nhan.html");
        //exit;
    }
?>
