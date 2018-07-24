<!DOCTYPE html>
<html>
<head>
<title>Login</title>
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
		<h1>NC TELECOM</h1>
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left"> 
				<div class="agile-row">
					<div class="head">
						<!--<h2>Login to your site</h2>-->
            <?php
              include_once "DBConnect.php";
              /*if(!isset($_SESSION)){
                  session_start();
                  //session_destroy();
              }*/
              session_start();
              if(isset($_SESSION['message'])){
                  echo $_SESSION['message']."<br><br>";
                  unset($_SESSION['message']);
              }
              if(isset($_SESSION['user'])){
                  unset($_SESSION['user']);
                  //header("Location: dang-nhap.html");
              }
              if(isset($_SESSION['admin'])){
                  unset($_SESSION['admin']);
                  //header("Location: dang-nhap.html");
              }
              /*if(isset($_SESSION['admin'])){
                header("Location: admin.php");
                exit;
              }
              if(isset($_SESSION['user'])){
                header("Location: trang-chu-cua-toi.html");
                exit;
              }*/
          ?>
						<!--<span class="fa fa-lock"></span>-->
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top"> 	
						<form action="xu-ly-dang-nhap.html" method="post"> 
							<input type="text" class="name" name="phone" Placeholder="Your phone" required=""/>
							<input type="password" class="password" name="Password" Placeholder="Password" required=""/>
							<input type="submit" name = "bt_signin" value="Login Now"> 
						</form> 	
					</div> 
					<div class="login-agileits-bottom"> 
						<h6><a href="quen-so-dien-thoai.html">Forgot your password?</a></h6>
            or<br>
            <h6><a href="dang-ky.html">Have not account</a></h6>
					</div>

				</div>  
			</div>  
		</div>
		<!-- //login form -->
		
		<!-- <div class="login-agileits-bottom1"> 
			<h3>or login with</h3>
		</div> -->
		
		<!-- social icons -->
		<!-- <div class="social_icons agileinfo">
			<ul class="top-links">
				<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
				<li><a href="#" class="vimeo"><i class="fa fa-vimeo"></i></a></li>
			</ul>
		</div> -->
		<!-- //social icons -->
		
		<!-- copyright -->
		<div class="copyright">
			<p> © 2018 NC Login Form. All rights reserved | Design by <a href="http://tel4vn.vn/" target="_blank">TEL4VN</a></p>
		</div>
		<!-- //copyright --> 
	</div>	
	<!-- //main -->
	
</body>
</html>