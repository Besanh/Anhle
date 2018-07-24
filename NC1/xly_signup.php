<?php
    include_once "DBConnect.php";
    session_start();
    
    if(isset($_POST['bt_signup'])){
        $name = htmlspecialchars($_POST['name']);
        $validateName = preg_match("/^[a-zA-Z0-9\s]+$/", $name);
        if (!$validateName) {
            $_SESSION['message'] = "Invalid name";
            header("Location: dang-ky.html");
        }
        else{
            // NHẬN DẠNG SDT
            //$regEx = '/^0(1\d{9}|8\d{8}|9\d{8})$/';
            $phone = '';
            $phone = $_POST['phone'];
            $phone_rex = strlen($phone);
            if($phone_rex == 10 || $phone_rex == 11){
                // NẾU CÓ GIÁ TRỊ THÌ BÁO LỖI
                $sql1 ="SELECT phone FROM `users` WHERE phone='$phone'";
                if(mysqli_num_rows(mysqli_query($con, $sql1)) > 0){
                    $_SESSION['message'] = "Invalid phone number";
                    header("Location: dang-ky.html");
                }
                else {
                    //$regPass = "/^([A-Z]){1}([\w_]+){5,31}$/";
                    $password = $_POST['Password'];
                    $conPass = $_POST['conPass'];
                    //$match1 = preg_match($regPass, $password);
                    if($password === $conPass){
                            $count = strlen($password);
                            if($count >= 6){
                                $string = "QWERTYUIOPASDFGHJKLZXCVBNM0123456789"; //0-61
                                    $stringLength = strlen($string);//62
                                    //30
                                    $token = '';
                                    for($i=1;$i<=5;$i++){
                                        $start = rand(0,$stringLength-1);
                                        $token.=substr($string,$start,1);
                                    }
                                    $token = $token;
                                    $ch = curl_init();

                                            curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/send_sms");
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"#param#\",\"port\":[10],\"param\":[{\"number\":\"$phone\",\"text_param\":[\"Code NC SMS is $token\"],\"user_id\":1}]}");
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
                                            $_SESSION['token'] = $token;
                                            $_SESSION['name'] = $name;
                                            $_SESSION['password'] = $password;
                                            $_SESSION['phone'] = $phone;
                                            header("Location: ma-xac-nhan.html");
                                            exit;
                            }
                            else{
                                $_SESSION['message'] = "Password need minimum 6 characters";
                                header("Location: dang-ky.html");
                                exit;
                            }
                    }
                    else{
                      $_SESSION['message'] = "Wrong password";
                      header("Location: dang-ky.html");
                    }
                }
            }
            else{
                $_SESSION['message'] = "The password is 10 or 12 digits";
                header("Location: dang-ky.html");
            }
        }
    }
?>