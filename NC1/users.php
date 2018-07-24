<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
	  <link href="NC1/font-awesome.css" rel="stylesheet">
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
        if(!isset($_SESSION)){
            session_start();
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
                    <li><a href="hop-thu-den-admin.html" style="color: white">Inbox</a></li>
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
    <?php 
        // BU?C 2: TÌM T?NG S? RECORDS
        $result = mysqli_query($con, 'select count(id) as total from `nghia_nhantin`.`users`');
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
        $result = mysqli_query($con, "SELECT * FROM `nghia_nhantin`.`users` ORDER BY id ASC LIMIT $start, $limit");
 
        ?>
        <div>
    <table class="table table-striped" style="text-align: center;" border="1">
      <thead style="font-weight:bold; background-color: #1ab188;">
            <tr>
                <th width="10%" style="text-align: center;">Id</th>
                <th width="15%" style="text-align: center;">Name</th>
                <th width="15%" style="text-align: center;">Phone</th>
                <th width="10%" style="text-align: center;">Original money</th>
                <th width="10%" style="text-align: center;">Add money</th>
                <th width="20%" style="text-align: center;">Current money</th>
                <th width="20%" style="text-align: center;">Lastest date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
            ?>
                  <tr class="productInfo-<?= $row['id']?>">
                      <td>
                          <?= $row['id'];?>
                      </td>
                      <td>
                          <?= $row['name']?>
                      </td>
                      <td>
                          <?= $row['phone']?>
                      </td>
                      <td>
                          <?= $row['fund']?>
                      </td>
                      <td>
                          <?= $row['fund_add']?>
                      </td>
                      <td>
                          <?= $row['fund_result']?>
                      </td>
                      <td>
                          <?= $row['date']?>
                      </td>
                  </tr>
                <?php endwhile?>
              <?php endif?>
        </tbody>
    </table>
    </div>
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
