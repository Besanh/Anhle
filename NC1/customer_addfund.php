<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="NC1/tel4vn.png">
    <link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
	  <link href="NC1/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style rel="stylesheet">
        .acc{
            clear:both;
            text-align:right;
        }
    </style>
</head>

  <body>
    <div style="margin-top:10px">
    <?php
        include_once "DBConnect.php";
        if(!isset($_SESSION)){
            session_start();
            //session_destroy();
        }
        if(isset($_SESSION['user'])){
            echo '<div class="acc">'."Welcome "."<a href='tai-khoan-cua-toi.html'>".$_SESSION['user']."</a></div>";
        }
        else{
            header("Location: index.php");
            exit;
        }
    ?>
    
     <div id="header">
        <nav class="navbar navbar-inverse" style="padding: 5px 20px;">
            <div class="navbar-header" style="margin-right:20px;margin-left:20px;">
                <a href="trang-chu-cua-toi.html"><img src="NC1/NC_Telecom.png" class="img-circle" alt="NC_Telecom" width="50" height="50"></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>

            <div class="navbar-collapse collapse" id="menu">
                <ul class="nav navbar-nav">
                    <li><a href="trang-chu-cua-toi.html" style="color:white">Dashboard</a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="" style="color:white">Inbox<span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:black">
                            <li><a href="xu-ly-tin-nhan-den.html" style="color:white;background-color:black">Inbox</a></li>
                            <li><a href="gui-tin-nhan.html" style="color:white;background-color:black">Send SMS</a></li>
                            <li><a href="tin-nhan-da-gui-da-nhan.html" style="color:white;background-color:black">Sent</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="" style="color:white;">Setting<span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:black">
                            <li><a href="dang-xuat.html" style="color:white;background-color:black">Logout</a></li>
                            <li><a href="sua-doi-thong-tin-ca-nhan.html" style="color:white;background-color:black">Manage</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="huong-dan-khach-hang-nap-tien.html" style="color:white">Add fund</a></li>
                </ul>

            </div>
        </nav>
    </div>
   
   <!-- PHAN HIEN THI HUONG DAN NAP TIEN -->
   <div class="container" style="font-size:17px;">
       <span style="font-weight:bold;margin-left:200px;margin-right:100px;font-size:30px;color:black;">Quý khách vui lòng thực hiện đúng theo các bước sau</span><br>
       <div style="margin-left:350px;margin-right:100px;font-weight:bold;font-size:20px;color:black;">Quý khách lưu ý cần thực hiện đúng theo hướng dẫn.</b></div>
       <br>
       <div style="margin-left:350px;margin-right:200px">
       <span>Ngân hàng:</span><span style="font-weight:bold;"> OCB</span><br><br>
       <span>Người nhận:</span><span style="font-weight:bold;"> công ty NC Telecom</span><br><br>
       <span>Số tài khoản: </span><span style="font-weight:bold;">0005100006778006</span><br><br>
       <span>Số tiền: ghi số tiền cần nạp vào tài khoản của quý khách</span><br><br>
       <span>Nội dung: tên người nạp tiền, số điện thoại người nạp tiền, nạp tiền cho user </span>
       <br><br>
       <div>Ví dụ:</div><br>
       <span>Ngân hàng nhận: OCB</span><br><br>
       <span>Người nhận: NC Telecom</span><br><br>
       <span>Số tài khoản: 0005100006778006</span><br><br>
       <span>Số tiền: 500000</span><br><br>
       <span>Nội dung: Nguyễn Văn A, 0909000000, nạp tiền cho tài khoản user 012345678933</span><br><br>
       </div>
       
     
   </div>
  </div>
</body>
</html>