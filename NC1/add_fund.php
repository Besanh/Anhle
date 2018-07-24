<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add fund</title>
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
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    ?>
    <div>
    <table class="table table-striped" style="text-align: center;" border="1">
      <thead style="font-weight:bold; background-color: #1ab188;">
            <tr>
                <th width="10%" style="text-align: center;">Id</th>
                <th width="20%" style="text-align: center;">Name</th>
                <th width="40%" style="text-align: center;">Phone</th>
                <th width="20%" style="text-align: center;">Add</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM `nghia_nhantin`.`users` ORDER BY id ASC";
                $result = mysqli_query($con, $sql);
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
                        <select name="product-qty" id="product-qty" class="form-control txtQty" width="20" data-id="<?=$row['id']?>">
                            <?php for($i=0; $i<=10; $i++):?>
                            <option value="<?=$i*10000?>">
                                <?=$i*10000?>
                            </option>
                            <?php endfor?>
                        </select>
                      </td>
                  </tr>
                <?php endwhile?>
              <?php endif?>
        </tbody>
    </table>
	</div>
 </div>
 </body>
 </html>
<script>
    $(document).ready(function(){
        $('.txtQty').change(function () {
            var qty = $(this).val();
            var idUser = $(this).attr('data-id');
            var action = "update";
            $.ajax({
                url: "NC1/add.php",
                data: {
                    id: idUser, // $_POST['id']
                    quantity: qty, // $_POST['quantity]
                    action: action
                },
                type: "POST",
                dataType: 'JSON',
                success: function (result) {
                    alert("Ðã thêm thành công vào");
                }
            })
        })
    });
</script>