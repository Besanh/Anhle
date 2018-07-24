<?php
    include_once "DBConnect.php";
   	date_default_timezone_set('Asia/Ho_Chi_Minh');
    if(!isset($_SESSION)){
        session_start();
        //session_destroy();
    }
    if(isset($_POST['bt_submit'])){
        if(!isset($_POST['check'])){
            $_SESSION['message'] = "Please choose port";
            header("Location: gui-tin-nhan-admin.html");
        }
        else{
            if(empty($_POST['recipient'])){
                $_SESSION['message'] = "Please type phone";
                header("Location: gui-tin-nhan-admin.html");
            }
            else{
                if(empty($_POST['content'])){
                    $_SESSION['message'] = "Please type content";
                    header("Location: gui-tin-nhan-admin.html");
                }
                else{
                    $recipient = $_POST['recipient'];
                    $content = $_POST['content'];
                    
                    /*************************************************************************
                     * V?N Ð? LÀ LÀM SAO L?Y ÐU?C KEY TUONG ?NG SDT BÊN KIA Ð? ÐUA VÀO BÊN ÐÂY
                     ************************************************************************/
                    $arr = ['0886004084','0886005084', '0886005654','0886007136','0886004390','0886004518',
                                '0914170334','0914135330','01693073840','01694451598','01657642501','01687681290',
                                '01638974045','01678162215','01634521494','01634891652','0907443962','0907438260',
                                '0907436316','0907439644','0907448461','0907433804','0907439871', '0903020817', '01694125030', 
                                '01639950625', '0914144704', '0914161067', '', '0914176474', '', '0901800680'
                    ];
                    $port = $_POST['check'];    // DANG LA DANG MANG
                    //var_dump($port);echo "<br>";
                    // CHI XU LY DUOC GIA TRI DON
                    for($i = 0; $i < count($port); $i++){
                        for($j = 0; $j < count($arr); $j++){
                            if($port[$i] == $j){
                                //echo $arr[$j]." ";  // DAY LA VALUE TUONG UNG VS PORT
                                $p = $port[$i];
                                  
                                  $ch = curl_init();
                                  curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/send_sms");
                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"#param#\",\"port\":[$p],\"param\":[{\"number\":\"$recipient\",\"text_param\":[\"$content\"],\"user_id\":1}]}'");
                                  curl_setopt($ch, CURLOPT_POST, 1);
                                  curl_setopt($ch, CURLOPT_USERPWD, "admin" . ":" . "TEL4VN.COM");
                                  $headers = array();
                                  $headers[] = "Content-Type: application/json";
                                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                  $result = curl_exec($ch);
                                  if (curl_errno($ch)) {
                                      echo 'Error:' . curl_error($ch);
                                  }
                                  curl_close ($ch);
                                  print_r($result);exit;
                                  sleep(5);
                                  
                                  $user = $_SESSION['user'];
                                  $ch = curl_init();
                                  curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
                                  curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/query_sms_result");
                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"number\":\"$user\", \"port\":[$p],\"user_id\":[1]}");
                                  curl_setopt($ch, CURLOPT_POST, 1);
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
                                  $id_user = mysqli_query($con, "SELECT id FROM users WHERE phone = '$user' ");
                                  while ($row = mysqli_fetch_assoc($id_user)) {
                                      $a = $row['id'];
                                  }
                                  $sender = $arr[$j];
                                  for($k = 0; $k < count($temp['result']); $k++){
                                      //$sender = "01687681290";
                                      $receiver = $temp['result'][$k]['number'];
                                      $status = $temp['result'][$k]["status"];
                                  }
                                  // PH?N X? LÝ N?U PORT SIM H?T TI?N
                                  if($status == "FAILED"){
                                      $sql = "INSERT INTO `nghia_nhantin`.`inbsent`(id_user, port, date, time, sender, receiver, status, note, content)
                                              VALUES ('$a', '$p', CURRENT_DATE(), CURRENT_TIME(), '$sender', '$receiver', '$status', '$note', '$content')";
                                      $conn = mysqli_query($con, $sql);
                                      $sql2 = "INSERT INTO `nghia_nhantin`.`sms`(`id_user`, `phone`, `port`, `status`) 
                                              SELECT i.id_user, u.phone, i.port, i.status FROM inbsent as i 
                                              INNER JOIN users as u 
                                              ON u.id = i.id_user
                                              WHERE NOT EXISTS (SELECT * FROM sms WHERE id_user = i.id_user AND phone = u.phone AND port = i.port)
                                              ORDER BY i.id_user ASC";
                                      $con2 = mysqli_query($con, $sql2);
                                      $_SESSION['message'] = "Sent failed";
                                      $sql3 = "UPDATE `users` SET `fund_result`= '$fund_result' WHERE phone = '$user';";
                                      $con3 = mysqli_query($con, $sql3);
                                      $_SESSION['fund_result'] = $fund_result;
                                      header("Location: gui-tin-nhan-admin.html");
                                  }
                                  else{
                                      $sql = "INSERT INTO `nghia_nhantin`.`inbsent`(id_user, port, date, time, sender, receiver, status, note, content)
                                              VALUES ('$a', '$p', CURRENT_DATE(), CURRENT_TIME(), '$sender', '$receiver', '$status', '$note', '$content')";
                                      $conn = mysqli_query($con, $sql);
                                      $sql2 = "INSERT INTO `nghia_nhantin`.`sms`(`id_user`, `phone`, `port`, `status`) 
                                              SELECT i.id_user, u.phone, i.port, i.status FROM inbsent as i 
                                              INNER JOIN users as u 
                                              ON u.id = i.id_user
                                              WHERE NOT EXISTS (SELECT * FROM sms WHERE id_user = i.id_user AND phone = u.phone AND port = i.port)
                                              ORDER BY i.id_user ASC";
                                      $con2 = mysqli_query($con, $sql2);
                                      $sql3 = "UPDATE `users` SET `fund_result`= '$fund_result' WHERE phone = '$user';";
                                      $con3 = mysqli_query($con, $sql3);
                                      $_SESSION['message'] = "Sent sucessfully";
                                      $_SESSION['fund_result'] = $fund_result;
                                      header("Location: gui-tin-nhan-admin.html");
                                  }
                                
                                
                            }
                        }
                        
                    }
                     
                }
            }
        }
    }
?>