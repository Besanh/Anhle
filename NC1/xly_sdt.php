<?php
    include_once "DBConnect.php";
    session_start();
    if(isset($_POST['bt_forget'])){
        $regEx = '/^0(1\d{9}|9\d{8})$/';
        $phone = $_POST['phone_fg'];
        $match = preg_match($regEx, $phone);   // trả về 1 nếu matched, 0 thì ngc lại
        if($match == 1){
            // NẾU CÓ GIÁ TRỊ THÌ BÁO LỖI
            $sql1 ="SELECT phone FROM `nghia_nhantin`.`users` WHERE phone='$phone'";
            if(mysqli_num_rows(mysqli_query($con, $sql1)) > 0){
                $string = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789"; //0-61
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
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"#param#\",\"port\":[24],\"param\":[{\"number\":\"$phone\",\"text_param\":[\"Confirm code is $token\"],\"user_id\":1}]}");
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
                $_SESSION['phone'] = $phone;
                header("Location: gui-lai-captcha.html");
            }
            else{
                $_SESSION['message'] = "Phone number is not exists";
                header("Location: quen-so-dien-thoai.html");
            }
        }
        else {
            $_SESSION['message'] = "Invalid phone number";
            header("Location: quen-so-dien-thoai.html");
        }
    }
?>