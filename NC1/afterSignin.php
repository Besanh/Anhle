<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Sms</title>
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
        .copyright {
            clear: both;
            padding: 2em 0 0em;
            text-align: center;
            position: absolute;
            bottom: 0;
            margin-left: 50px;
            position: fixed;
        }
        .copyright p {
            font-size: 1.2em;
            /* color: black; */
            line-height:1.8em;
            letter-spacing: 2px;
        }
        .copyright p a{
            color: black;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            -ms-transition: 0.5s all;
            transition: 0.5s all;
        }
        .copyright p a:hover{
            color: #ff4c4c;
            text-decoration: none;
        }
        .acc{
            clear:both;
            text-align:right;
        }
    </style>
  	<script>
          addEventListener("load", function () {
              setTimeout(hideURLbar, 0);
          }, false);
  
          function hideURLbar() {
              window.scrollTo(0, 1);
          }
      </script>
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
          $_SESSION['fund_result'];
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
    <form method='post' action='xu-ly-gui-tin-nhan.html' enctype="multipart/form-data">
        <?php
            $arr = ['0','1','2','3','4','5',
            '6','7','8','9','10','11',
            '12','13','14','15','16','17',
            '18','19','20','21','22','23',
            '24', '25', '26',
                '27',
                '29','31'
            ];// 27 28 29
        //     for($i = 0; $i < count($arr); $i++){?>
                <!-- <label for="<?= $i?>"><?= $i?></label>
                <input type="checkbox" name="check[]" id="<?= $i?>" value="<?= $arr[$i]?>"> -->
        <div style="margin-left:25px;">
            <?php foreach($arr as $key => $a):?>
                <label for="<?= $a?>"><?= $a?></label>
                <input type="checkbox" name="check[]" id="<?= $key?>" value="<?= $a?>">
            <?php endforeach?>
        </div>
        <?php
          if(isset($_SESSION['message'])){
              echo "<div style='margin-left: 520px;'>".$_SESSION['message']."</div>";
              unset($_SESSION['message']);
          }
        ?>
        <br>
        <label style="margin-left: 430px;" for="recipient">To:</label>
        <div style="margin-left: 430px;">
            <input size="39" style="height:40px" type="text" class="name" name="recipient" Placeholder="Your phone" required/>
        </div>
        <br>
        <label style="margin-left: 430px;" for="recipient">Content:</label>
        <div style="margin-left: 430px; position: relative;">
            <textarea style="max-height:300px; max-width:350px;" cols="42" rows="10" type="text" name="content" class="text" Placeholder="Your text" required></textarea><br>
        </div>
        <br><br>
        <div style="clear:both; margin-left: 430px; margin-right: 360px; position: static;">
            <input class="btn btn-block btn-lg" style="background-color: #0f9d58; color:white" type="submit" name = "bt_submit" value="Send"> 
        </div>
    </form>
    </div>
	</div>
</body>
</html>