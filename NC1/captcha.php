<!DOCTYPE html>
<html>
<head>
<title>Confirm OTP</title>
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
						<!--<h2>Confirm form</h2>-->
            <?php
               // VI PHIA DUOI DA CO PHAN XU LY NEU KHONG CO SESSION TRUYEN QUA ROI NEN O DAY K LAM GI NUA
              include_once "DBConnect.php";
              if(!isset($_SESSION)){
                  session_start();
                  //session_destroy();
              }
              if(isset($_SESSION['message'])){
                  echo $_SESSION['message']."<br><br>";
                  unset($_SESSION['message']);
              }
          ?>
						
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top"> 	
						<form action="#" method="post" id="formid"> 
							<input type="text" class="name" name="captcha" Placeholder="Please type your OTP" required=""/>
							<input type="submit" name = "bt_confirm" value="Confirm"> 
						</form> 	
					</div> 
					<!-- <div class="login-agileits-bottom"> 
						<h6><a href="#">Forgot your password?</a></h6>
					</div>  -->
          <br><br>
          <!--<div>
              <h6>If your have not receiver OTP.</h6><a href="#">Click here</a>
          </div>-->
          
				</div>  
			</div>  
		</div>
		
   <?php
        /**********************************************************************************
         * PH?N X? LÝ G?I MÃ XÁC NH?N Ð?N S? ÐI?N THO?I
         * CÓ 1 V?N Ð? LÀ G?I MÃ XÁC NH?N THÌ OK
         * NHUNG NGU?I DKI G?I L?I MÃ VÀO SDT, THÌ C?N L?Y N?I DUNG TIN NH?N ÐÓ Ð? XÁC NH?N
         * 1. T?O FORM BÌNH THU?NG, NH?N NÚT THÌ S? G?I MÃ XÁC NH?N T?I SDT R?I CHUY?N T?I
         * TRANG SUBMIT CAPTCHA. NH?P CAPTCHA ÐÃ NH?N VÀ SO SÁNH
        **********************************************************************************/
        
        if(isset($_SESSION['phone'])){
            $phone = $_SESSION['phone'];
            
            // THUC HIEN VIEC NEU USER NAY GUI QUA 3 YEU CAU NHAP CAPTCHA THI NGUNG LAI\
            // TH?C HI?N XÁC NH?N TN NH?N ÐU?C Ð? SO SÁNH TOKEN
            // N?U SDT TRÙNG SDT TRONG QUERY THÌ X? LÝ
            // KI?M TRA VI?C XÁC NH?N CAPTCHA
            if(isset($_POST['bt_confirm'])){
                $token = $_POST['captcha'];
                if($token == $_SESSION['token']){
                    // $password = md5($_POST['password']);
                    $password = md5($_SESSION['password']);
                    $name = $_SESSION['name'];
                    $fund = 5000;
                    $sql = "INSERT INTO `nghia_nhantin`.`users`(name, phone, token, password, fund, fund_result)
                            VALUES ('$name', '$phone', '$token', '$password', '$fund', '$fund') ";
                    mysqli_query($con, $sql);
                    $_SESSION['message'] = "Successfull. Please signin to continue my services";
                    header("Location: dang-nhap.html");
                    exit;
                }
                else{
                    $_SESSION['message'] = "Wrong OTP. Please retype your OTP";
                    header("Location: ma-xac-nhan.html");
                    exit;
                }
            }
                    
            
        }
        else{
            header("Location: index.php");
            exit;
        }
    ?>
		
		<!-- copyright -->
		<div class="copyright">
			<p> Â© 2018 NC OTP Form. All rights reserved | Design by <a href="http://tel4vn.vn/" target="_blank">TEL4VN</a></p>
		</div>
		<!-- //copyright --> 
	</div>	
	<!-- //main -->
	
</body>
</html>
<script>
  $(window).bind("pageshow", function() { // update hidden input field 
      $('#formid')[0].reset(); 
  });
</script>