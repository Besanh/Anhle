<?php
    include_once "DBConnect.php";
        session_start();

        if(isset($_POST['bt_edit'])){
            $user = $_SESSION['user'];
            $rePass = $_POST['rePass'];
            $newPass = $_POST['newPass'];
            $conPass = $_POST['conPass'];
            $sql1 = "SELECT password FROM `nghia_nhantin`.`users` WHERE password = '$rePass' AND phone = '$user'";
            $con1 = mysqli_query($con, $sql1);
            if(mysqli_num_rows($con1) > 0)
            {
                // XU LY NEU PASS HIEN TAI DUNG
                if($conPass != $newPass){
                    $_SESSION['message'] = "Confirm password is wrong";
                    header("Location: sua-doi-thong-tin-ca-nhan.html");
                }
                else{
                    if($newPass == $rePass){
                        $_SESSION['message'] = "New password should be different from old password";
                        header("Location: sua-doi-thong-tin-ca-nhan.html");
                    }
                    else{
                        $sql2 = "UPDATE `nghia_nhantin`.`users` SET `password`='$newPass' WHERE phone = '$user'";
                        mysqli_query($con, $sql2);
                        header("Location: http://nhantin.net");
                    }
                }
            }
            else{
                $_SESSION['message'] = "Recent password is wrong";
                header("Location: sua-doi-thong-tin-ca-nhan.html");
            }
        }
            
        
    
?>