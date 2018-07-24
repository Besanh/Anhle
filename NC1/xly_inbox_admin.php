<?php
    include_once "DBConnect.php";
    if(!isset($_SESSION)) session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if(!isset($_SESSION['admin'])){
         header("Location: index.php");
         exit;
    }
    else{
        $arr = ['0886004084','0886005084', '0886005654','0886007136','0886004390','0886004518',
                                '0914170334','0914135330','01693073840','01694451598','01657642501','01687681290',
                                '01638974045','01678162215','01634521494','01634891652','0907443962','0907438260',
                                '0907436316','0907439644','0907448461','0907433804','0907439871', '0903020817', '01694125030', 
                                '01639950625', '0914144704', '0914161067', '', '0914176474', '', '0901800680'
                    ];
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
        $pattern1 = array('/VIETTELKM/', '/KMNAPTHE/', '/VIETTELQC/', '/VIETTELDV/', '//');
        $replace1 = array('VIETTEL KM', 'KM NAPTHE', 'VIETTEL QC', 'VIETTEL DV', ' ');
        $temp1 = json_decode( preg_replace($pattern1, $replace1, $result), true );
        if(count($temp1['sms']) == 0){}
        else{
            //echo "<pre>";print_r($result);echo "</pre>";exit;
            //echo $temp;exit;
            // INSERT VÀO DB
            /******************************************************************
             * V?N Ð? ? CH? LÀ LÀM SAO CH? INSERT 1 L?N, Ð? KHI KH RELOAD     *
             * TRANG ÐÓ L?I THÌ S? KHÔNG B? GHI TRÙNG DB                      *
             * ****************************************************************/
            for($k = 0; $k < count($temp1['sms']); $k++){
                $port = $temp1['sms'][$k]['port'];
                $number_receiver = $arr[$port];
                $number_send = $temp1['sms'][$k]["number"];
                $timestamp = $temp1['sms'][$k]["timestamp"];
                $content = $temp1['sms'][$k]["text"];
                $sql2 = "SELECT * FROM inbox 
                         WHERE  port = '$port' 
                         AND number_receiver = '$number_receiver'
                         AND number_send = '$number_send' 
                         AND datetime = '$timestamp'
                         AND content = '$content'";
                $conn2 = mysqli_query($con, $sql2);
                if(mysqli_num_rows($conn2) > 0)
                {
                    //header("Location: hop-thu-den.html");	
                }
                else{
                    $sql2 = "INSERT IGNORE INTO inbox(port, number_receiver, number_send, datetime, content)
                            VALUES ('$port', '$number_receiver', '$number_send', '$timestamp', '$content')";
                    mysqli_query($con, $sql2);
                }
            }
        }
        
        
        // PHAN TRUY VAN TUNG PORT DE DAM BAO KHONG SOT TN
        for($j = 0; $j < count($arr); $j++){
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
            curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/query_incoming_sms?port=$j,flag=all");
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
            $pattern = array('/VIETTELKM/', '/KMNAPTHE/', '/VIETTELQC/', '/VIETTELDV/', '/STTTTTPHCM/', '//');
            //$pattern = "";
            //$replace = " ";
            $replace = array('VIETTEL KM', 'KM NAPTHE', 'VIETTEL QC', 'VIETTEL DV', 'STTTT TPHCM', ' ');
            $temp = json_decode( preg_replace($pattern, $replace, $result), true );
            //print_r($temp);
            if(count($temp['sms']) == 0){
            }
           // KHI CO TN MOI THI LUU NO VAO RECHARGE
              else {
                for($k = 0; $k < count($temp['sms']); $k++){
                    $port = $temp['sms'][$k]['port'];
                    $number_receiver = $arr[$port];
                    $number_send = $temp['sms'][$k]["number"];
                    $timestamp = $temp['sms'][$k]["timestamp"];
                    $content = $temp['sms'][$k]["text"];
                    $sql1 = "SELECT * FROM `nghia_nhantin`.`inbox` 
                             WHERE  port = '$port' 
                             AND number_receiver = '$number_receiver'
                             AND number_send = '$number_send' 
                             AND datetime = '$timestamp'
                             AND content = '$content'";
                    $conn1 = mysqli_query($con, $sql1);
                    if(mysqli_num_rows($conn1) > 0){
                    }
                    else{
                        $sql = "INSERT IGNORE INTO `nghia_nhantin`.`inbox`(port, number_receiver, number_send, datetime, content)
                                VALUES ('$port', '$number_receiver', '$number_send', '$timestamp', '$content')";
                        $conn = mysqli_query($con, $sql);
                    }
                }
            }
       }
    }            
	header("Location: hop-thu-den-admin.html");
?>
