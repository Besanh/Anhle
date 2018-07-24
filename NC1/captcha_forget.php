<!DOCTYPE html>
<html>
<head>
<title>Confirm captcha</title>
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
	
	<!-- web font --> 
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<!-- //web font --> 
	
</head>
<body>
	<!-- main -->
	<div class="main">
		<h1>NC Captcha Form</h1>
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left"> 
				<div class="agile-row">
					<div class="head">
						<h2>Confirm form</h2>
            <?php
                 // VI PHIA DUOI DA CO PHAN XU LY NEU KHONG CO SESSION TRUYEN QUA ROI NEN O DAY K LAM GI NUA
                include_once "DBConnect.php";
                if(!isset($_SESSION)){
                    session_start();
                    //session_destroy();
                }
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>
						<!--<span class="fa fa-lock"></span>-->
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top"> 	
						<form action="#" method="post"> 
							<input type="text" class="name" name="captcha" Placeholder="Please type your captcha" required=""/>
							<input type="submit" name = "bt_conForget" value="Confirm"> 
						</form> 	
					</div>

				</div>  
			</div>  
		</div>
		<!-- //login form -->
   <?php
        if(isset($_SESSION['phone'])){
            $phone = $_SESSION['phone'];
            if(isset($_POST['bt_conForget'])){
                $token = $_POST['captcha'];
                if($token == $_SESSION['token']){
                // VI SDT DA DUOC KT CO TRONG DB HAY KHONG NEN KHONG CAN XET DK KHI CO PASS
                    $sql = "SELECT password FROM `nghia_nhantin`.`users` WHERE phone = $phone";
                    $n = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($n))
                    {   
                        $pass = $row['password'];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/send_sms");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"#param#\",\"port\":[24],\"param\":[{\"number\":\"$phone\",\"text_param\":[\"Your password is $pass\"],\"user_id\":1}]}");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_USERPWD, "admin" . ":" . "TEL4VN.COM");
                        $headers = array();
                        $headers[] = "Content-Type: application/json";
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        $result = curl_exec($ch);
                        if (curl_errno($ch)) {
                            echo 'Error:' . curl_error($ch);
                        }
                        curl_close ($ch);
                        $_SESSION['message'] = "Your password just sent to your phone. Please login to continue service";
                        header("Location: signin.php");
                        //exit;
                    }
                }
                else{
                    $_SESSION['message'] = "Wrong captcha. Please retype your captcha";
                    header("Location: captcha_forget.php");
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
			<p> © 2018 NC Captcha Form. All rights reserved | Design by <a href="http://tel4vn.vn/" target="_blank">TEL4VN</a></p>
		</div>
		<!-- //copyright --> 
	</div>
	<!-- //main -->
	
</body>
</html>