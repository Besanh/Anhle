<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
	  <link href="NC1/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="NC1/manage.css">
    <link rel="shortcut icon" href="NC1/tel4vn.png">
    <style rel="stylesheet">
        .acc{
            clear:both;
            text-align:right;
        }
    </style>
</head>
<body>
<div style="margin-top:10px;">
    <?php
        include_once "DBConnect.php";
        /*if(!isset($_SESSION)){
            session_start();
            //session_destroy();
        }*/
        session_start();
        if(isset($_SESSION['admin'])){
            echo '<div class="acc">'."Welcome "."<a href='trang-quan-tri.html'>"."admin"."</a></div>";
        }
        else{
            header("Location: index.php");
            exit;
        }
        
    ?>
    <div id="header" id="menu">
        <nav class="navbar navbar-inverse" style="padding: 5px 20px;">
            <div class="navbar-header" style="margin-right:20px;margin-left:20px;">
                  <a href="trang-quan-tri.html"><img src="NC1/NC_Telecom.png" class="img-circle" alt="NC_Telecom" width="50" height="50"></a>
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                          <span class="sr-only">Toggle navigation</span>
                          
                      </button>
                
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <i class="glyphicon glyphicon-user" style="float:left;background-color:white;margin:15px 0px 10px 10px;"></i>
                    <li><a href="trang-quan-tri.html" style="color: white">Add user</a></li>
                    <i class="glyphicon glyphicon-list-alt" style="float:left;background-color:white;margin:15px 0px 10px 10px;"></i>
                    <li><a href="quan-ly.html" style="color: white">Manage</a></li>
                    <i class="glyphicon glyphicon-usd" style="float:left;background-color:white;margin:15px 5px 0px 10px;"></i>
                    <li><a href="them-tien.html" style="color: white">Add furd</a></li>
                    <i class="glyphicon glyphicon-pencil" style="float:left;background-color:white;margin:15px 0px 0px 10px;"></i>
                    <li><a href="gui-tin-nhan-admin.html" style="color: white">Send SMS</a></li>
                    <i class="glyphicon glyphicon-file" style="float:left;background-color:white;margin:15px 0px 0px 10px;"></i>
                    <li><a href="query-hop-thu-den-admin.html" style="color: white">Inbox</a></li>
                    <i class="glyphicon glyphicon-envelope" style="float:left;background-color:white;margin:15px 0px 0px 15px;"></i>
                    <li><a href="xu-ly-bao-cao-tin-nhan-ngan-hang.html" style="color: white">SMS Bank</a></li>
                    <li class="dropdown">
                        
                        <a data-toggle="dropdown" href="" style="color: white">Report<span class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color:black;background-color:black">
                            <li><a href="bao-cao-nguoi-dung.html" style="color: white;background-color:black">Users</a></li>
                            <li><a href="bao-cao-he-thong.html" style="color: white;background-color:black">Systems</a></li>
                            <li><a href="bao-cao-tin-nhan.html" style="color: white;background-color:black">SMS</a></li>
                            <li><a href="xu-ly-bao-cao-tai-chinh.html" style="color: white;background-color:black">Final</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
    <!-- PHẦN ADD USERS -->
    <!-- main -->
	<div class="main">
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left"> 
				<div class="agile-row">
					<div class="head">
            <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message']."<br>";
                    unset($_SESSION['message']);
                }
            ?>
					</div>					
					<div class="clear"></div>
					<div class="login-agileits-top">
						<form action="xu-ly-them-nguoi-dung.html" method="post"> 
						<input type="text" class="name" name="name" Placeholder="Your name" required=""/>
						<input type="text" class="name" name="phone" Placeholder="Your phone" required=""/>
						<input type="password" class="password" name="Password" Placeholder="Password" required=""/>
   			    <input type="password" class="password" name="conPass" Placeholder="Confirm Password" required=""/>
						<input type="submit" name = "bt_add" value="Add now"> 
						</form>
				</div>  
			</div>  
		</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-body">
            <p>You have new messages</p>
            <p><a href="tin-nhan-tai-khoan-nap-tien.html">Read messages</a></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<script>
   
</script>
</body>
</html>
