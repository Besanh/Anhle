<!DOCTYPE html>
<html>
<head>
<title>Xác nhận số điện thoại</title>
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
	<link rel="shortcut icon" href="NC1/tel4vn.png" type="image/x-icon">
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
	<link href="NC1/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="NC1/font-awesome.css" rel="stylesheet"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom Theme files -->
	
	<!-- web font --> 
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<!-- //web font --> 
	
</head>
<body>
	<!-- main -->
	<div class="main">
		<h1>PLEASE TYPE YOUR PHONE</h1><br>
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left">
      <?php
              include_once "DBConnect.php";
              if(!isset($_SESSION)){
                  session_start();
                  session_destroy();   
              }
              if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
          ?>
				<div class="agile-row">
					<div class="head">
            
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top"> 	
						<form action="NC1/xly_sdt.php" method="post"> 
							<input type="text" class="name" name="phone_fg" Placeholder="Your phone" required=""/>
							<input type="submit" name = "bt_forget" value="Confirm Now"> 
						</form>
            </div>
				</div>  
			</div>  
		</div>
		
		<!-- copyright -->
		<div class="copyright">
			<p> © 2018 All rights reserved | Design by <a href="http://tel4vn.vn/" target="_blank">TEL4VN</a></p>
		</div>
		<!-- //copyright --> 
	</div>	
	<!-- //main -->
	
</body>
</html>