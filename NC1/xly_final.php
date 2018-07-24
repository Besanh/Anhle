<?php
    include_once "DBConnect.php";
        /*
          OCB 06/06 13:17
          TK 0005100006778006
          (+) 18,000,000 VND
          N/dung: ACB TO OCB
          So du: 42,032,885 VND
        */
    function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }

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
        $pattern = array('/VIETTELKM/', '/KMNAPTHE/', '/VIETTELQC/', '/VIETTELDV/', '/STTTT/');
        $replace = array('VIETTEL KM', 'KM NAPTHE', 'VIETTEL QC', 'VIETTEL DV', '/STTTT /');
        $temp = json_decode( preg_replace($pattern, $replace, $result), true );
        //echo "<pre>";print_r($result);echo "</pre>";exit;
        //echo $temp;exit;
        // INSERT VÀO DB
        /******************************************************************
         * V?N Ð? ? CH? LÀ LÀM SAO CH? INSERT 1 L?N, Ð? KHI KH RELOAD     *
         * TRANG ÐÓ L?I THÌ S? KHÔNG B? GHI TRÙNG DB                      *
         * ****************************************************************/
            if(count($temp['sms']) == 0){
                header("Location: bao-cao-tai-chinh.html");
                exit;
            }
            else {
                for($i = 0; $i < count($temp['sms']); $i++){
                $phone = $temp['sms'][$i]['number'];
                $timestamp = $temp['sms'][$i]['timestamp'];
                $content = $temp['sms'][$i]['text'];
                $sql1 = "SELECT * FROM recharge 
                        WHERE phone =  '$phone',
                        AND history_recharge = '$timestamp'
                        AND content = '$content' ";
                $conn1 = mysqli_query($con, $sql1);
                // NEU TIM THAY TN DA CO THI KHONG LAM GI CA
                if(mysqli_num_rows($conn1) > 0){
                    die;
                }
                else{
                    $sql2 = "INSERT IGNORE INTO recharge(phone, history_recharge, content)
                            VALUES ('$phone', '$timestamp', '$content')";
                    mysqli_query($con, $sql2);
                }
            }
        }
        
        $sql3 = "SELECT content FROM recharge WHERE phone = '+84976764205' ORDER BY id ASC";
        $con3 = mysqli_query($con, $sql3);
        if(mysqli_num_rows($con3) > 0){
            //$a = implode(", ", $row);
                
            while($row = mysqli_fetch_assoc($con3)){
                $content = implode(", ", $row);
                for($i = 0; $i < count($row); $i++){
                    

                    // EXPLODE CHUYEN CHUOI THANH MANG
                    
                    $start = "OCB";
                    $end = "TK";
                    $kq = GetBetween($content, $start, $end);   // TIME NAP TIEN
                    if($kq != ""){
                        $start1 = "(";
                        $end1 = ")";
                        $kq1 = GetBetween($content, $start1, $end1);    // CONG TIEN HAY TRU TIEN
                        if($kq1 != ""){
                            $start2 = "(+)";
                            $end2 = "VND";
                            $kq2 = GetBetween($content, $start2, $end2);    // SO TIEN CONG VAO
                            if($kq2 != "") {
                                $start3 = "N/dung:";
                                $end3 = ",";
                                $kq3 = GetBetween($content, $start3, $end3);    // NGUOI NAP TIEN
                                if($kq3 != ""){
                                    $start4 = "user";
                                    $end4 = "So du";
                                    $kq4 = GetBetween($content, $start4, $end4);
                                    $kq4 = preg_replace('/\s+/', '', $kq4);     // NGUOI DC NAP TIEN
                                    if($kq4 != ""){
                                        $sql = "SELECT phone FROM users WHERE phone = '$kq4'";
                                        $conn = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($conn) > 0){  // SO KHOP SDT
                                            $sql1 = "SELECT id FROM users WHERE phone = '$kq4' ";
                                            $conn1 = mysqli_query($con, $sql1);
                                            if(mysqli_num_rows($conn1) > 0){
                                                $row = mysqli_fetch_assoc($conn1);
                                                $id = $row['id'];
                                                if($kq != "" && $kq1 != "" && $kq2 != "" && $kq3 != "" && $kq4 != ""){
                                                    $sqll1 = "SELECT * FROM rp_final
                                                              WHERE id_user = '$id'
                                                              AND sender = '$kq3'
                                                              AND date = '$kq'
                                                              AND money = '$kq2'
                                                              AND receiver = '$kq4'";
                                                    $connl1 = mysqli_query($con, $sqll1);
                                                    if(mysqli_num_rows($connl1) > 0){
                                                        header("Location: bao-cao-tai-chinh.html");
                                                        exit;
                                                    }
                                                    else{
                                                        $sqll2 = "INSERT INTO rp_final (`id_user`, `sender`, `date`, `money`, `receiver`) 
                                                                VALUES ('$id', '$kq3', '$kq', '$kq2', '$kq4')";
                                                        mysqli_query($con, $sqll2);
                                                    }
                                                    header("Location: bao-cao-tai-chinh.html");
                                                    exit;
                                                }
                                            }
                                            
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
        }


    
    
    // for($i = 0; $i < count($arr); $i++){
    //     $start = "OCB";
    //     $end = "TK";
    //     $kq = GetBetween($arr[$i], $start, $end);
    
        
    //     $start1 = "(";
    //     $end1 = ")";
    //     $kq1 = GetBetween($arr[$i], $start1, $end1);
    
        
    //     $start2 = "(+)";
    //     $end2 = "N/dung";
    //     $kq2 = GetBetween($arr[$i], $start2, $end2);
    
        
    //     $start3 = "user";
    //     $end3 = "So du";
    //     $kq3 = GetBetween($arr[$i], $start3, $end3);
    //     $kq3 = preg_replace('/\s+/', '', $kq3);
    //     $sql = "SELECT phone FROM users WHERE phone = '$kq3'";
    //     $conn = mysqli_query($con, $sql);
    //     while($row = mysqli_fetch_assoc($conn)){
    //         echo "ok";
    //     }
    //     // if($kq != "" && $kq1 != "" && $kq2 != "" && $kq3 != ""){
    //     //     echo $kq."ttt".$kq1."ttt".$kq2."ttt".$kq3."<br>";
    //     // }
    // }
    
    //echo $n->GetBetween($t, $start, $end);
    //var_dump(implode(",", $arr));
    
    /*$start = "OCB";
    $end = "TK";
    echo $n->GetBetween($content, $start, $end);

    $n1 = new regex;
    $start1 = "TK";
    $end1 = "(+)";
    echo $n1->GetBetween($content, $start1, $end1);

    $n2 = new regex;
    $start2 = "(+)";
    $end2 = "N/dung";
    echo $n2->GetBetween($content, $start2, $end2);

    $n3 = new regex;
    $start3 = "user";
    $end3 = "So du";
    $result = $n3->GetBetween($content, $start3, $end3);
    var_dump($result);

    // $n4 = new regex;
    // $start4 = "$result,";
    // $end4 = ",";
    // $result1 = $n4->GetBetween($content, $start4, $end4);
    $result1 = preg_replace('/\s+/', '', $result);
    var_dump($result1);
    $sql = "SELECT phone FROM users WHERE phone = '$result1'";
    $conn = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($conn)){
        echo "ok";
    }*/
?>