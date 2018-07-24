<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Fund</title>
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
    <div style="margin-top: 10px;font-size:1em">
        <?php
             include_once "DBConnect.php";
             if(!isset($_SESSION)){
                 session_start();
                 //session_destroy();
             }
             if(isset($_SESSION['user'])){
                 echo '<div class="acc">'."Welcome "."<a href='tai-khoan-cua-toi.html' title='Your account'>".$_SESSION['user']."</a></div>";
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
                    <li><a href="tai-khoan-cua-toi.html" style="color:white">Balance</a></li>
                    <li><a href="dang-xuat.html" style="color:white">Change</a></li>
                </ul>
            </div>
        </nav>
    </div>
    
    
    <div class="container">
    <div class="form">  
      <div class="tab-content">
      <div id="login">   
          <div style="font-size:15px;font-weight: bold;">Now:</div><br>
          <div style="font-size:20px">
            <?php
                $user = $_SESSION['user'];
                $sql = "SELECT fund_result FROM `nghia_nhantin`.`users` WHERE phone = '$user'";
                $noww = mysqli_query($con, $sql);
                        
                if($noww){
                    $row = mysqli_fetch_assoc($noww);
                    echo "<pre>";
                    print_r($row['fund_result']." VND");
                    echo "</pre>";
                }
            ?>
          </div>
          </div>
          <br><br>
          
          <div style="font-size:15px;font-weight: bold;">Added:</div><br>
          <div style="font-size:20px">
            <?php
                $user = $_SESSION['user'];
                $sql = "SELECT fund_add FROM `nghia_nhantin`.`users` WHERE phone = '$user'";
                $noww = mysqli_query($con, $sql);
                        
                if($noww){
                    $row = mysqli_fetch_assoc($noww);
                    echo "<pre>";
                    print_r($row['fund_add']." VND");
                    echo "</pre>";
                }
            ?>
          </div>
          </div>
          <br><br>
          
          <div id='login'>
          <div style="font-size:15px;font-weight: bold;">Originally:</div><br>
          <div  style="font-size:20px;">
            <?php
                $sql = "SELECT fund FROM `nghia_nhantin`.`users` WHERE phone = '$user'";
                $og = mysqli_query($con, $sql); 
                if($og){
                    $row = mysqli_fetch_assoc($og);
                    echo "<pre>";
                    print_r($row['fund']." VND");
                    echo "</pre>";
                }
            ?>
            </div>
          </div>
      </div>
    </div>
    </div>
</body>
</html>