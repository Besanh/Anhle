<!DOCTYPE html>
<html>
<head>
<title>Sign up</title>
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
	<link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
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
      <div>1. Name contains no special characters</div><br/>
      <div>2. Password length of at least 6 characters</div><br>
				<div class="agile-row">
					<div class="head">
						
            <?php
              if(!isset($_SESSION)){
                  session_start();
                  session_destroy();
              }
              if(isset($_SESSION['message'])){
                echo $_SESSION['message']."<br><br>";
                unset($_SESSION['message']);
              }
            ?>
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top"> 	
						<form action="xu-ly-dang-ky-1.html" method="post" id="myForm"> 
						<input type="text" class="name" name="name" Placeholder="Your name" required=""/>
						<input type="text" class="name" name="phone" Placeholder="Your phone" required=""/>
						<input type="password" class="password" name="Password" Placeholder="Password" required=""/>
   			    <input type="password" class="password" name="conPass" Placeholder="Confirm Password" required=""/>
						<input type="submit" name = "bt_signup" value="Sign up Now" onclick="removeDummy();"> 
						</form> 	
					</div> 
					<div class="login-agileits-bottom"> 
						<h6><a href="dang-nhap.html">Already have account?</a></h6>
					</div>

				</div>  
			</div>  
		</div>
		<!-- //login form -->
		
		<!-- <div class="login-agileits-bottom1"> 
			<h3>or login with</h3>
		</div> -->
		
		<!-- copyright -->
		<div class="copyright">
			<p> © 2018 NC Login Form. All rights reserved | Design by <a href="http://tel4vn.vn/" target="_blank">TEL4VN</a></p>
		</div>
		<!-- //copyright --> 
	</div>	
	<!-- //main -->
	
</body>
</html>