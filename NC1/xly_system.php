<?php
    include_once "DBConnect.php";
    
    $arr = ['0886004084','0886005084', '0886005654','0886007136','0886004390','0886004518',
                                '0914170334','0914135330','01693073840','01694451598','01657642501','01687681290',
                                '01638974045','01678162215','01634521494','01634891652','0907443962','0907438260',
                                '0907436316','0907439644','0907448461','0907433804','0907439871', '0903020817', '01694125030', 
                                '01639950625', '0914144704', '0914161067', '', '0914176474', '', '0901800680'
            ];
    for($i = 0; $i < count($arr); $i++){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/get_port_info?port=$i&info_type=imei,imsi,iccid,smsc,type,number,reg,slot,callstate,signal,gprs");
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
        $temp = json_decode($result, true);
        // VAN DE LA LAM SAO DE LAY VALUE DUNG VS KEY

        for($j = 0; $j < count($temp['info']); $j++){
            $port = $temp['info'][$j]['port'];
            $status = $temp['info'][$j]['reg'];
            $number = $arr[$i];
        }
            $sql10 = "SELECT * FROM  `nghia_nhantin`.`system` 
                     WHERE port = '$port'
                     AND number = '$number'
                     AND status = '$status'";
            $conn10 = mysqli_query($con, $sql10);
            if(mysqli_num_rows($conn10) > 0)
            {
                //header("Location: system.php");
                //exit;
            }
            else{
                $sql = "INSERT INTO `nghia_nhantin`.`system`(`port`, `number`, `status`) VALUES
                        ('$port', '$number','$status')";
                $conn = mysqli_query($con, $sql);
                
            }
            // echo "<pre>";
            // print_r($number);
            // echo "</pre>";
    }
    
?>