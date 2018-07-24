<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Final</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="NC1/style1.css" rel="stylesheet" type="text/css" media="all" />
	  <link href="NC1/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="NC1/final.css">
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
    
      <?php 
        // BU?C 2: TÌM T?NG S? RECORDS
        $result = mysqli_query($con, 'select count(id) as total from `nghia_nhantin`.`rp_final`');
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
        $result = mysqli_query($con, "SELECT id_user, GROUP_CONCAT(date SEPARATOR ',') as date, GROUP_CONCAT( DISTINCT receiver SEPARATOR ',') AS user 
                                      FROM `nghia_nhantin`.`rp_final` 
                                      GROUP BY id_user 
                                      HAVING COUNT(*) >= 1 LIMIT $start, $limit");
 
        ?>
        <div>
    <table class="table table-striped" style="text-align: center;" border="1">
      <thead style="font-weight:bold; background-color: #1ab188;">
            <tr>
                <th width="10%" style="text-align: center;">Id</th>
                <th width="30%" style="text-align: center;">User</th>
                <th width="20%" style="text-align: center;">History recharge</th>
                <th width="40%" style="text-align: center;">History use money</th>
            </tr>
        </thead>
        <tbody>
              <tr class="productInfo-<?= $row['id']?>">
                  <?php
                      //$sql = "SELECT GROUP_CONCAT(DISTINCT status) as status,GROUP_CONCAT( DISTINCT port) as port, GROUP_CONCAT( DISTINCT phone) as phone, COUNT(status) as number FROM sms GROUP BY port";
                      if(mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                  ?>
                  <tr class="productInfo-<?= $row['id_user']?>">
                      <td>
                          <?= $row['id_user'];?>
                      </td>
                      <td>
                          <?= $row['user']?>
                      </td>
                      <td>
                          <?= $row['date']."<br>"?>
                      </td>
                      <td>
                          
                      </td>
                  </tr>
                <?php endwhile?>
              <?php endif?>
              </tr>
        </tbody>
    </table>
    </div>
    <div class="pagination">
           <?php 
            // PH?N HI?N TH? PHÂN TRANG
            // BU?C 7: HI?N TH? PHÂN TRANG
 
            // n?u current_page > 1 và total_page > 1 m?i hi?n th? nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="bao-cao-tai-chinh.html?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // L?p kho?ng gi?a
            for ($i = 1; $i <= $total_page; $i++){
                // N?u là trang hi?n t?i thì hi?n th? th? span
                // ngu?c l?i hi?n th? th? a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="bao-cao-tai-chinh.html?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // n?u current_page < $total_page và total_page > 1 m?i hi?n th? nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="bao-cao-tai-chinh.html?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
        </div>
</div>
</body>
</html>
