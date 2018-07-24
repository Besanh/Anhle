<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox and Sent</title>
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
        .date .time .sender .receiver .status .content{
            height: 100%;
        }
        .date{
            width: 100px;
            border: 1px solid #1ab188;
            float: left;
            text-align: center;
        }
        .time{
            width: 100px;
            border: 1px solid #1ab188;
            float: left;
            text-align: center;
        }
        .sender{
            width: 200px;
            border: 1px solid #1ab188;
            float: left;
            text-align: center;
        }
        .receiver{
            width: 200px;
            border: 1px solid #1ab188;
            float: left;
            text-align: center;
        }
        .status{
            width: 150px;
            border: 1px solid #1ab188;
            float: left;
            text-align: center;
        }
        .content{
            width: 350px;
            border: 1px solid #1ab188;
            float: left;
            text-align: center;
        }
        .tc{
            height: 30px;
            margin-bottom: 7px;
            border-top: 1px solid #1ab188;
        }
        .title{
            clear: both;
            margin: 0px auto;
            font-weight: bold;
            background-color: #1ab188;
        }
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
        if(isset($_SESSION['user'])){
            
            echo '<div class="acc">'."Welcome "."<a href='tai-khoan-cua-toi.html'>".$_SESSION['user']."</a></div>";
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
    <?php 
        $phone = $_SESSION['user'];
        $query = "SELECT id_user FROM `nghia_nhantin`.`sms` WHERE phone = '$phone' GROUP BY id_user";
        $r = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($r);
        $rr = $row['id_user'];
    
        // BU?C 2: TÌM T?NG S? RECORDS
        $result = mysqli_query($con, 'select count(id) as total from `nghia_nhantin`.`inbsent`');
        $row = mysqli_fetch_assoc($result);
        $total_records = $row['total'];
 
        // BU?C 3: TÌM LIMIT VÀ CURRENT_PAGE
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
 
        // BU?C 4: TÍNH TOÁN TOTAL_PAGE VÀ START
        // t?ng s? trang
        $total_page = ceil($total_records / $limit);
 
        // Gi?i h?n current_page trong kho?ng 1 d?n total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
 
        // Tìm Start
        $start = ($current_page - 1) * $limit;
 
        // BU?C 5: TRUY V?N L?Y DANH SÁCH TIN T?C
        // Có limit và start r?i thì truy v?n CSDL l?y danh sách tin t?c
        
        $result = mysqli_query($con, "SELECT * FROM `nghia_nhantin`.`inbsent` WHERE id_user = '$rr' ORDER BY id DESC LIMIT $start, $limit");
 
        ?>
        <div>
        <table class="table table-striped" style="text-align: center;" border="1">
      <thead style="font-weight:bold; background-color: #1ab188;">
            <tr>
                <th width="5%" style="text-align: center;">Port</th>
                <th width="10%" style="text-align: center;">Date</th>
                <th width="10%" style="text-align: center;">Time</th>
                <th width="10%" style="text-align: center;">Sender</th>
                <th width="10%" style="text-align: center;">Receiver</th>
                <th width="5%" style="text-align: center;">Status</th>
                <th width="5%" style="text-align: center;">Note</th>
                <th width="35%" style="text-align: center;">Content</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if(mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
            ?>
                  <tr class="productInfo-<?= $row['id']?>">
                      <td>
                          <?= $row['port'];?>
                      </td>
                      <td>
                          <?= $row['date']?>
                      </td>
                      <td>
                            <?= $row['time']?>
                      </td>
                      <td>
                            <?= $row['sender']?>
                      </td>
                      <td>
                            <?= $row['receiver']?>
                      </td>
                      <td>
                            <?= $row['status']?>
                      </td>
                      <td>
                            <?= $row['note']?>
                      </td>
                      <td>
                            <?= $row['content']?>
                      </td>
                  </tr>
                <?php endwhile?>
              <?php endif?>
        </tbody>
    </table>
    </div>
        <div class="pagination">
                       <?php
            $nPageShow = 5;
            if ($nPageShow%2==0) {
        			$nPageShow 		= $nPageShow + 1;
        		}
        $paginationHTML 	= '';
		
		
		if($total_page > 1){
			$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			//echo $actual_link; die;
			
			$actual_link = explode('?page=', $actual_link)[0];
			//$actual_link = $arr[0];

			$start 	= '';
			$prev 	= '';
			if($current_page > 1){
                $start 	= "<li><a href='$actual_link?page=1'>Start</a></li>";
                
				$prev 	= "<li><a href='$actual_link?page=".($current_page-1)."'><<</a></li>";
            }
            
			$next 	= '';
			$end 	= '';
			if($current_page < $total_page){
				$next 	= "<li><a href='$actual_link?page=".($current_page+1)."'>>></a></li>";
				$end 	= "<li><a href='$actual_link?page=".$total_page."'>End</a></li>";
			}

		
			if($nPageShow < $total_page){
				
				if($current_page == 1 ){
					$startPage 	= 1;
					$endPage 	= $nPageShow;
                }
                else if($current_page == $total_page){
                    $startPage 	= $total_page - $nPageShow + 1;
					$endPage 	= $current_page;
                }
				
				else{
					// p=4 => s = 4-(11-1)/2 = -1
					$startPage		= $current_page - ($nPageShow-1)/2;

					//4 + (11-1)/2 = 9
					$endPage		= $current_page + ($nPageShow-1)/2;

					if($startPage < 1){
						$endPage	= $endPage + 1; 
						$startPage 	= 1; 
					}
					if($endPage > $total_page){
						$endPage	= $total_page;
	
						$startPage 	= $endPage - $nPageShow + 1;
					}
				}

			}
			
            //$nPageShow >= $total_page
			else{
				$startPage		= 1;
				$endPage		= $total_page;
			}
			/**************/
			$listPages = '';
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $current_page) {
					$listPages .= "<li class='active'><a href='#'>".$i.'</a>';
				}
				else{
					$listPages .= "<li><a href='$actual_link?page=".$i."'>".$i.'</a>';
				}
			}
			$paginationHTML = '<ul class="pagination pagination-lg">'.$start.$prev.$listPages.$next.$end.'</ul>';
		}
		echo $paginationHTML;
	
           ?>
    </div>
    </div>
</body>
</html>