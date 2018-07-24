<!DOCTYPE html>
<html>
<head>
<title>SMS</title>
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="shortcut icon" href="NC1/tel4vn.png">
  	<script>
          addEventListener("load", function () {
              setTimeout(hideURLbar, 0);
          }, false);
  
          function hideURLbar() {
              window.scrollTo(0, 1);
          }
      </script>
    <style rel="stylesheet">
        .acc{
            clear:both;
            text-align:right;
        }
    </style>
</head>
<body>
  <div style="margin-top:10px">
  <?php
        include_once "DBConnect.php";
        if(!isset($_SESSION)){
            session_start();
            //session_destroy();
        }
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
    <div class = "container">
    <form method='post' action='xu-ly-admin-gui-tin-nhan.html' enctype="multipart/form-data">
        <?php echo $_SESSION['fund_result'];
            $arr = ['0','1','2','3','4','5',
            '6','7','8','9','10','11',
            '12','13','14','15','16','17',
            '18','19','20','21','22','23',
            '24', '25', '26',
                '27',
                '29', '31'
            ];// 27 28 29
        //     for($i = 0; $i < count($arr); $i++){?>
                <!-- <label for="<?= $i?>"><?= $i?></label>
                <input type="checkbox" name="check[]" id="<?= $i?>" value="<?= $arr[$i]?>"> -->
        <div style="margin-left:25px;">
            <?php foreach($arr as $key => $a):?>
                <label for="<?= $a?>"><?= $a?></label>
                <input type="checkbox" name="check[]" id="<?= $a?>" value="<?= $a?>">
            <?php endforeach?>
        </div>
        <?php
          if(isset($_SESSION['message'])){
              echo "<div style='margin-left: 510px;'>".$_SESSION['message']."</div>";
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