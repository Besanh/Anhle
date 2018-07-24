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
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" href="tel4vn.png">
    <style rel="stylesheet">
        .acc{
            clear:both;
            text-align:right;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
        include_once "DBConnect.php";
        session_start();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if(isset($_SESSION['user'])){
            echo '<div class="acc">'."Welcome "."<a href='myAccount.php'>"."admin"."</a></div>";
        }
        else{
             header("Location: index.php");
             exit;
         }
    ?>
    <div id="header">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="menu">
                <ul class="nav navbar-nav ">
                    <li><a href="admin.php">Add user</a></li>
                    <li><a href="manage.php">Manage</a></li>
                    <li><a href="#">Add furd</a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="">Report<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">Users</a></li>
                            <li><a href="">Systems</a></li>
                            <li><a href="sms.php">SMS</a></li>
                            <li><a href="">Final</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['message'])){
            echo "<p>".$_SESSION['message']."</p>"."<br>";
            unset($_SESSION['message']);
        }
    ?>
    <!-- PHẦN ADD USERS -->
    <form class="navbar-form" action="addUser.php" method="post">
        <p class="row">
            <div class="form">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" class="form-control" placeholder="First Name">
            </div>
        </p>
        
        <p class="row">
            <div class="form">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" class="form-control" placeholder="Last Name">
            </div>
        </p>
        
        <p class="row">
            <div class="form">
                <label  class="form" for="phone">Phone number</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone number">
            </div>
        </p>
        <p class="row">
            <div class="form">
                <label for="password">Set password</label>
                <input type="password" name="password" class="form-control" placeholder="Set password">
            </div>
        </p>
        <button type="submit" name="bt_add" class="btn btn-default">Add</button>
    </form>
</div>
</body>
</html>