<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Home Page</title>
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
    <div style="margin-top: 10px">
        <?php
            //////// TRANG CHU CUA TOI ////////
            
            include_once "DBConnect.php";
            /*if(!isset($_SESSION)){
                session_start();
                //session_destroy();
            }*/
            session_start();
            if(isset($_SESSION['user'])){
                $_SESSION['fund_result'];
                echo '<div class="acc">'."Welcome "."<a href='tai-khoan-cua-toi.html'>".$_SESSION['user']."</a></div>";
            }
            else{
                header("Location: http://nhantin.net");
                exit;
            }
            /*if(header("Location: http://nhantin.net") || header("Location: http://nhantin.net/") || header("Location: http://nhantin.net/index.php")){
                $_SESSION['user'];
                header("Location: trang-chu-cua-toi.html");
                exit;
            }
            if(header("Location: index.php")){
                header("Location: trang-chu-cua-toi.html");
            }
            if(header("Location: 404.html")){
                header("Location: trang-chu-cua-toi.html");
            }*/
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
    <div class="container">
  <div class="form">
      <div class="tab-content">
      <div id="login">   
          <div style="font-size:15px;font-weight: bold;">TODAY:</div><br>
          <div style="font-size:20px">
            <?php
                $user = $_SESSION['user'];
                $sql = "SELECT count(i.id_user) as soluong FROM `nghia_nhantin`.`inbsent` as i 
                        INNER JOIN users as u 
                        ON i.id_user = u.id 
                        WHERE i.date = CURDATE() AND u.phone = '$user' 
                        ORDER BY u.id ASC";
                $today = mysqli_query($con, $sql);
                        
                if($today){
                    $row = mysqli_fetch_assoc($today);
                    echo "<pre>";
                    print_r($row['soluong']." messages");
                    echo "</pre>";
                }
                else{
                    echo "<pre>";
                    print_r("0 messages");
                    echo "</pre>";
                }
            ?>
            </div>
          </div>
          <br><br>
          <div id='login'>
          <div style="font-size:15px;font-weight: bold;">ALL:</div><br>
          <div  style="font-size:20px;">
            <?php
                $sql = "SELECT count(i.id_user) as soluong FROM `nghia_nhantin`.`inbsent` as i
                        INNER JOIN users as u
                        ON i.id_user = u.id
                        WHERE u.phone = '$user'
                        ORDER BY u.id ASC";
                $today = mysqli_query($con, $sql); 
                if($today){
                    $row = mysqli_fetch_assoc($today);
                    echo "<pre>";
                    print_r($row['soluong']." messages");
                    echo "</pre>";
                }
                else{
                    echo "<pre>";
                    print_r("0 messages");
                    echo "</pre>";
                }
            ?>
            </div>
          </div>
      </div>
      </div>
      <!-- tab-content -->
      </div>
      </div>
  </body>
</html>
