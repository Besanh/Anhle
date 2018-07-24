<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox</title>
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
        
        
        /* Style The Dropdown Button */
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        
        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}
        
        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
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
            echo '<div class="acc">'."Welcome "."<a href='tai-khoan-cua-toi.html'>".admin."</a></div>";
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
    <form method='post' action='' enctype="multipart/form-data">
      
        <?php
            $mang = ['0','1','2','3','4','5',
            '6','7','8','9','10','11',
            '12','13','14','15','16','17',
            '18','19','20','21','22','23',
            '24', '25', '26',
                '27','28',
                '29','30','31'
            ];?>
            <label>Select port</label>
            
            <select name="port" id="port" class="port">
              <option name="check" id="id255" value="255">All</option> 
              <?php foreach($mang as  $key =>$a):?>
                  <?php $selected = ($value == $_POST['port']) ? ' selected' : '';?>
                  <option name="check[]" id="id<?=$a?>" value="<?=$a?>" <?=$selected?> ><?=$a?></option>
                  <?php endforeach?>
            </select>
              
            </div>
	        <input style="margin-left:170px;margin-top:-22px;float:left" type="submit" name = "bt_watch" value="Watch"> 
                 
        <div>
        <div style="margin-left:250px;margin-top:-22px;float:left">
            <form action="" method="post">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <br>
        <?php 
                // BU?C 2: TÌM T?NG S? RECORDS
                $kq = mysqli_query($con, 'select count(id) as total from inbox');
                $row = mysqli_fetch_assoc($kq);
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
                $lastId = mysqli_insert_id($con);
                $kq = mysqli_query($con, "SELECT * FROM inbox  ORDER BY id DESC LIMIT $start, $limit");
        
                ?>

        <table class="table table-striped" style="text-align: center;" border="1">
      <thead style="font-weight:bold; background-color: #1ab188;">
            <tr>
                <th width="5%" style="text-align: center;">Port</th>
                <th width="15%" style="text-align: center;">Number Receiver</th>
                <th width="15%" style="text-align: center;">Number Send</th>
                <th width="15%" style="text-align: center;">Date</th>
                <th width="15%" style="text-align: center;">Time</th>
                <th width="35%" style="text-align: center;">Content</th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($_POST['ok'])):?>
        <style type="text/css">
            #b{display:none;}
#c{display:none;}
}</style>
              <?php $search = addslashes($_POST['search']);
              $query = "SELECT * FROM `inbox` WHERE content LIKE '%$search%' ORDER BY port ASC";
              $conn = mysqli_query($con, $query);?>
              <?php
                      if(mysqli_num_rows($conn) > 0):
                          while ($row1 = mysqli_fetch_assoc($conn)):
                  ?>
                        <tr id="a" style="background-color:#d5d9e0" class="productInfo-<?= $row1['id']?>">
                            <td>
                                <?= $row1['port'];?>
                            </td>
                            <td>
                            <?= $row1['number_receiver'];?>
                            </td>
                            <td>
                                <?= $row1['number_send']?>
                            </td>
                            <td>
                                  <?php $str = $row1['datetime']?>
                                  <?= date("d/m/Y", strtotime($str));?>
                            </td>
                            <td>
                                  <?= date("H:i:s", strtotime($str));?>
                            </td>
                            <td>
                                  <?= $row1['content']?>
                            </td>
                        </tr>
                      <?php endwhile?>
                    <?php endif?>
                    
            <?php endif?>
            
            
        <?php $arr = ['0','1','2','3','4','5',
                                '6','7','8','9','10','11',
                                '12','13','14','15','16','17',
                                '18','19','20','21','22','23',
                                '24', '25', '26',
                                    '27','28',
                                    '29', '30', '31'
                    ];
		?>
        <?php if(isset($_POST['bt_watch'])):?>
                    <?php 
                    $port = $_POST['port'];
                    $ch = curl_init();
            curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
            curl_setopt($ch, CURLOPT_URL, "http://14.169.209.75/api/query_incoming_sms?port=$port,flag=all");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    
            curl_setopt($ch, CURLOPT_USERPWD, "admin" . ":" . "TEL4VN.COM");
    
            $headers = array();
            $headers[] = "Content-Type: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);
            $pattern = array('/VIETTELKM/', '/KMNAPTHE/', '/VIETTELQC/', '/VIETTELDV/', '/STTTTTPHCM/', '//');
            //$pattern = "";
            //$replace = " ";
            $replace = array('VIETTEL KM', 'KM NAPTHE', 'VIETTEL QC', 'VIETTEL DV', 'STTTT TPHCM', ' ');
            $temp = json_decode( preg_replace($pattern, $replace, $result), true );
            //print_r($temp);
            if(count($temp['sms']) == 0){
              //header("Location: hop-thu-den.html");
              //exit;
            }
           // KHI CO TN MOI THI LUU NO VAO RECHARGE
              else {
                for($k = 0; $k < count($temp['sms']); $k++){
                    $port = $temp['sms'][$k]['port'];
                    $number_receiver = $arr[$port];
                    $number_send = $temp['sms'][$k]["number"];
                    $timestamp = $temp['sms'][$k]["timestamp"];
                    $content = $temp['sms'][$k]["text"];
                    $sql1 = "SELECT * FROM `inbox` 
                             WHERE  port = '$port' 
                             AND number_receiver = '$number_receiver'
                             AND number_send = '$number_send' 
                             AND datetime = '$timestamp'
                             AND content = '$content'";
                    $conn1 = mysqli_query($con, $sql1);
                    if(mysqli_num_rows($conn1) > 0)
                    {
                        //header("Location: hop-thu-den.html");	
                    }
                    else{
                        $sql = "INSERT IGNORE INTO `inbox`(port, number_receiver, number_send, datetime, content)
                                VALUES ('$port', '$number_receiver', '$number_send', '$timestamp', '$content')";
                        $conn = mysqli_query($con, $sql);
                    }
                }
            }
                    for($i = 0; $i < count($port); $i++):
                        for($j = 0; $j < count($arr); $j++):
                            if($port[$i] == $j):
                                //$p = $port[$i];
                                //var_dump($port);
                                if($port == '255'){
                                    $sql = "SELECT * FROM `inbox` ORDER BY id DESC";
                                    $result = mysqli_query($con, $sql);?>
                                
                                           <?php if(mysqli_num_rows($result) > 0):?>
                                                <?php while ($row = mysqli_fetch_assoc($result)):
                                        		?>
                                              <tr id="b" class="productInfo-<?= $row['id']?>">
                                                  <td>
                                                      <?= $row['port'];?>
                                                  </td>
                                                  <td>
                                                      <?= $row['number_receiver'];?>
                                                  </td>
                                                  <td>
                                                      <?= $row['number_send']?>
                                                  </td>
                                                  <td>
                                                        <?php $datetime = $row['datetime']?>
                                                        <?= date("d/m/Y", strtotime($datetime));?>
                                                  </td>
                                                  <td>
                                                        <?= date("H:i:s", strtotime($datetime))?>
                                                  </td>
                                                  <td>
                                                        <?= $row['content']?>
                                                  </td>
                                              </tr>
                                            <?php endwhile?>
                                            
                                          <?php endif?>
                                <?php }?>
                                <?php
                                if($port != '255'){
                                $sql = "SELECT * FROM `inbox` WHERE port = '$port' ORDER BY id DESC";
                                $result = mysqli_query($con, $sql);?>
                                           <?php if(mysqli_num_rows($result) > 0):?>
                                                <?php while ($row = mysqli_fetch_assoc($result)):
                                        		?>
                                              <tr id="b" class="productInfo-<?= $row['id']?>">
                                                  <td>
                                                      <?= $row['port'];?>
                                                  </td>
                                                  <td>
                                                      <?= $row['number_receiver'];?>
                                                  </td>
                                                  <td>
                                                      <?= $row['number_send']?>
                                                  </td>
                                                  <td>
                                                        <?php $datetime = $row['datetime']?>
                                                        <?= date("d/m/Y", strtotime($datetime));?>
                                                  </td>
                                                  <td>
                                                        <?= date("H:i:s", strtotime($datetime))?>
                                                  </td>
                                                  <td>
                                                        <?= $row['content']?>
                                                  </td>
                                              </tr>
                                            <?php endwhile?>
                                          <?php endif?>
                                    <?php }?>
							<?php endif?>
						<?php endfor?>
					<?php endfor?>
                
        <?php endif?>
        <?php if(!isset($_POST['bt_watch'])):?>
        <?php
                if(mysqli_num_rows($kq) > 0):
                    while ($row = mysqli_fetch_assoc($kq)):
            ?>
                  <tr id="c" class="productInfo-<?= $row['id']?>">
                      <td>
                          <?= $row['port'];?>
                      </td>
                      <td>
                      <?= $row['number_receiver'];?>
                      </td>
                      <td>
                          <?= $row['number_send']?>
                      </td>
                      <td>
                            <?php $datetime = $row['datetime']?>
                            <?= date("d/m/Y", strtotime($datetime));?>
                      </td>
                      <td>
                            <?= date("H:i:s", strtotime($datetime))?>
                      </td>
                      <td>
                            <?= $row['content']?>
                      </td>
                  </tr>
                <?php //unset($_POST['check']); 
                      endwhile
                ?>
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

        <?php endif?>
        
         
        </form>
    </div>
  </body>
</html>
<script type="text/javascript">
  //document.getElementById('port').value = "<?php echo $_POST['port'];?>";
</script>