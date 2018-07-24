<?php
    include_once "DBConnect.php";
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    session_start();
    if(isset($_POST['bt_signin'])){
        $phone = $_POST['phone'];
        $password = $_POST['Password'];
        $sql1 = "SELECT phone FROM `nghia_nhantin`.`users` WHERE phone = '$phone'";
        $conn1 = mysqli_query($con, $sql1);
        $sql2 = "SELECT password FROM `nghia_nhantin`.`users` WHERE password = '$password' AND phone = '$phone'";
        $conn2 = mysqli_query($con, $sql2);
        if(mysqli_num_rows($conn1) > 0){
            while ($row1 = mysqli_fetch_assoc($conn1)){
                if($row1['phone'] == '0976764205'){
                    if(mysqli_num_rows($conn2) > 0){
                        while ($row2 = mysqli_fetch_assoc($conn2)){
                            // TRANG ADMIN KHONG CAN THEM FUND VI NO CO QUYEN CAO NHAT CO THE THEM TIEN BAT CU USER NAO
                            $_SESSION['admin'] = $row1['phone'];
                            $sql = "UPDATE `nghia_nhantin`.`users` SET `date`=(CURRENT_TIMESTAMP) WHERE `phone`= '$phone'";
                            mysqli_query($con, $sql);
                            
                            // PHAN QUERY KHI ADMIN SIGN IN VAO SE QUERY DUOC CO TN TU NGAN HANG KHONG
                      // NEU CO THI THUC HIEN LUU DB VA TIM KIEM XEM CO TN CHUYEN TIEN NAO KHONG
                      // NEU CO TN DO THI THUC HIEN REGEX, THOA YEU CAU THI TU THEM TIEN VAO ACC USER TUONG UNG
                      function GetBetween($content,$start,$end){
                        $r = explode($start, $content);
                        if (isset($r[1])){
                            $r = explode($end, $r[1]);
                            return $r[0];
                        }
                        return '';
                      }
                        // TRUY VAN PORT DANG KY NGAN HANG
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
                        $pattern = array('/VIETTELKM/', '/KMNAPTHE/', '/VIETTELQC/', '/VIETTELDV/', '//');
                        $replace = array('VIETTEL KM', 'KM NAPTHE', 'VIETTEL QC', 'VIETTEL DV', ' ');
                        $temp = json_decode( preg_replace($pattern, $replace, $result), true );
                         // TRUY VAN XEM CO TN MOI KHONG
                            if(count($temp['sms']) == 0){
                                header("Location: trang-quan-tri.html");
                                exit;
                            }
                         // KHI CO TN MOI THI LUU NO VAO RECHARGE
                            else {
                                for($i = 0; $i < count($temp['sms']); $i++){
                                $phone = $temp['sms'][$i]['number'];
                                $timestamp = $temp['sms'][$i]['timestamp'];
                                $content = $temp['sms'][$i]['text'];
                                $sql1 = "SELECT * FROM `nghia_nhantin`.`recharge` 
                                        WHERE phone =  '$phone',
                                        AND history_recharge = '$timestamp'
                                        AND content = '$content' ";
                                $conn1 = mysqli_query($con, $sql1);
                                // NEU TIM THAY TN DA CO THI KHONG LAM GI CA
                                if(mysqli_num_rows($conn1) > 0){
                                    header("Location: bao-cao-tin-nhan-ngan-hang.html");
                                }
                                else{
                                    $sql2 = "INSERT IGNORE INTO `nghia_nhantin`.`recharge`(phone, history_recharge, content)
                                            VALUES ('$phone', '$timestamp', '$content')";
                                    mysqli_query($con, $sql2);
                                }
                            }
                        }
                        
                        /******************************************************
                         * BANG RECHARGE LA BANG LUU TIN NHAN CUA PORT DKI BANK
                         * NEU CO TN THI  LUU VAO DO
                         * VAN DE LA TRUY VAN KHONG CO TN MOI, NHUNG TRONG RECHARGE LAI CO TN CU CUA "OCB"
                         * THI
                         * SANG AD LOGIN THI TRUY VAN 1LAN, CHIEU LOGIN THI TRUY VAN 1LAN NUA THI SE BI TRUNG
                         *****************************************************/
                      
                        // TRUY VAN LOC LAY TN TU "OCB"
                        // GAP VAN DE LA NEU CON TN CU TU "OCB" THI NO VAN LAY
                        $sql3 = "SELECT content FROM `nghia_nhantin`.`recharge` WHERE phone = '+84976764205' ORDER BY id ASC";
                        $con3 = mysqli_query($con, $sql3);
                        
                        // NEU CO THI XET TUNG DKIEN XEM GIONG TN MAU CUA BANK KHONG, NEU CO THI LUU VAO DB
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
                                                        $sql = "SELECT phone FROM `nghia_nhantin`.`users` WHERE phone = '$kq4'";
                                                        $conn = mysqli_query($con, $sql);
                                                        if(mysqli_num_rows($conn) > 0){  // SO KHOP SDT
                                                            $sql1 = "SELECT id FROM `nghia_nhantin`.`users` WHERE phone = '$kq4' ";
                                                            $conn1 = mysqli_query($con, $sql1);
                                                            if(mysqli_num_rows($conn1) > 0){
                                                                $row = mysqli_fetch_assoc($conn1);
                                                                $id = $row['id'];
                      
                                                                // PHAN NAY SE XU LY DAM BAO CHI LAY TN MOI
                                                                if($kq != "" && $kq1 != "" && $kq2 != "" && $kq3 != "" && $kq4 != ""){
                                                                    $sqll1 = "SELECT * FROM `nghia_nhantin`.`rp_final`
                                                                              WHERE id_user = '$id'
                                                                              AND sender = '$kq3'
                                                                              AND date = '$kq'
                                                                              AND money = '$kq2'
                                                                              AND receiver = '$kq4'";
                                                                    $connl1 = mysqli_query($con, $sqll1);
                                                                    if(mysqli_num_rows($connl1) < 0){
                                                                        $sqll2 = "INSERT INTO `nghia_nhantin`.`rp_final` (`id_user`, `sender`, `date`, `money`, `receiver`) 
                                                                                VALUES ('$id', '$kq3', '$kq', '$kq2', '$kq4')";
                                                                        mysqli_query($con, $sqll2);
                                                                        $query = "update `nghia_nhantin`.`users` set fund_result = fund_result + '$kq2' where phone = '$kq4'";
                                                                        mysqli_query($con, $query);
                                                                    }
                                                                    else{
                                                                        header("Location: trang-quan-tri.html");
                                                                        exit;
                                                                    }
                                                                    //header("Location: trang-quan-tri.html");
                                                                    //exit;
                                                                }
                                                                else{
                                                                    header("Location: trang-quan-tri.html");
                                                                }
                                                            }
                                                            else{
                                                                header("Location: trang-quan-tri.html");
                                                            }
                                                        }
                                                        else{
                                                            header("Location: trang-quan-tri.html");
                                                        }
                                                    }
                                                    else{
                                                        header("Location: trang-quan-tri.html");
                                                    }
                                                }
                                                else{
                                                    header("Location: trang-quan-tri.html");
                                                }
                                            }
                                            else{
                                                header("Location: trang-quan-tri.html");
                                            }
                                        }
                                        else{
                                            header("Location: trang-quan-tri.html");
                                        }
                                    }
                                    else{
                                        header("Location: trang-quan-tri.html");
                                    }
                                }
                            }
                            
                        }
                        else{
                            header("Location: trang-quan-tri.html");
                        }
                            
                            header("Location: trang-quan-tri.html");
                            //exit;
                        }
                    }
                    else{
                        $_SESSION['message'] = "Password is wrong";
                        header("Location: dang-nhap.html");
                    }
                }
                else{
                    if(mysqli_num_rows($conn2) > 0){
                        while ($row2 = mysqli_fetch_assoc($conn2)){
                            $sql3 = "SELECT fund_result FROM `nghia_nhantin`.`users` WHERE phone = '$phone'";
                            $conn3 = mysqli_query($con, $sql3);
                            while($row3 = mysqli_fetch_assoc($conn3)){
                                $_SESSION['fund_result'] = $row3['fund_result'];
                            }
                            $sql = "UPDATE `nghia_nhantin`.`users` SET `date`=(CURRENT_TIMESTAMP) WHERE `phone`= '$phone'";
                            mysqli_query($con, $sql);
                            $_SESSION['user'] = $row1['phone'];
                            header("Location: trang-chu-cua-toi.html");
                        }
                    }
                    else{
                        $_SESSION['message'] = "Password is wrong";
                        header("Location: dang-nhap.html");
                    }
                }
            }
        }
        else{
            $_SESSION['message'] = "Phone number is wrong";
            header("Location: dang-nhap.html");
        }
    }
?>
