<!DOCTYPE html>
<html>
<head>
<title>Edit info</title>
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="NC1/tel4vn.ico" type="image/x-icon">
  <style rel="stylesheet">
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
    <!-- //Meta-Tags -->

	<!-- Custom Theme files -->
	<link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
	
</head>
<body>
<div style="margin-top: 10px; font-size: 1em;">
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
	<!-- main -->
	<div class="main">
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left"> 
				<div class="agile-row">
					<div class="head">
						<h2>Edit your info</h2>
						<!--<span class="fa fa-lock"></span>-->
            <?php
              if(!isset($_SESSION)){
                  session_start();
                  session_destroy();
              }
              if(isset($_SESSION['message'])){
                echo $_SESSION['message']."<br>";
                unset($_SESSION['message']);
              }
            ?>
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top"> 	
						<form action="xu-ly-sua-thong-tin-ca-nhan.html" method="post">
            <input type="password" class="password" name="rePass" Placeholder="Recent Password" required=""/>
						<input type="password" class="password" name="newPass" Placeholder="New Password" required=""/>
   			    <input type="password" class="password" name="conPass" Placeholder="Confirm Password" required=""/>
						<input type="submit" name = "bt_edit" value="Edit now"> 
						</form> 	
					</div>

				</div>  
			</div>  
		</div>
		
		<!-- copyright -->
		<!--<div class="copyright">
			<p> © 2018 NC Edit Form. All rights reserved | Design by <a href="http://tel4vn.vn/" target="_blank">TEL4VN</a></p>
		</div>-->
		<!-- //copyright --> 
	</div>	
	<!-- //main -->
	
</body>
</html>