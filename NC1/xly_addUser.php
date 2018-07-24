<?php
    /**
     * VẤN ĐỀ NỮA LÀ NẾU NGƯỜI DÙNG THẤY LINK THÌ CÓ THỂ NHẤP THẲNG VÀO LINK ĐÓ
     * CẦN CHỈNH SỬA ĐỂ KHI LÀ ADMIN THÌ MỚI VÀO ĐƯỢC TRANG NÀY
     */
    include_once "DBConnect.php";
    if(!isset($_SESSION)){
        session_start();
        //session_destroy();
    }
    if(isset($_POST['bt_add'])){
        $name = htmlspecialchars($_POST['name']);
        $phone = $_POST['phone'];
        $phone_rex = strlen($phone);
        if($phone_rex == 10 || $phone_rex == 11){
            $sql1 ="SELECT phone FROM `users` WHERE phone='$phone'";
            if(mysqli_num_rows(mysqli_query($con, $sql1)) > 0){
                $_SESSION['message'] = "Phone number already exists";
                header("Location: trang-quan-tri.html");
                exit;
            }
            else {
                $password = $_POST['Password'];
                $conPass = $_POST['conPass'];
                if($password === $conPass){
                        $count = strlen($password);
                        if($count >= 6){
                            $fund = 5000;
                            $sql = "INSERT INTO `nghia_nhantin`.`users`(name, phone, password, fund, fund_result)
                                    VALUES ('$name', '$phone', '$password', '$fund', '$fund') ";
                            mysqli_query($con, $sql);
                            $_SESSION['message'] = "Added successful";
                            header("Location:trang-quan-tri.html");
                            exit;
                        }
                        else{
                            $_SESSION['message'] = "Password need minimum 6 characters";
                            header("Location: trang-quan-tri.html");
                            exit;
                        }
                }
                else{
                    $_SESSION['message'] = "Confirm password is wrong";
                    header("Location: trang-quan-tri.html");
                    exit;
                }
            }
        }
        else{
            $_SESSION['message'] = "Phone is invalid";
            header("Location: trang-quan-tri.html");
            //exit;
        }
    }
?>