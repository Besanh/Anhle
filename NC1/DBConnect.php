<?php
            $servername = "localhost";
            $username = "nghia_nhantin";
            $password = "zRbk(K#V9[;+";
            $dbname = "nghia_nhantin";
            $con = mysqli_connect($servername,$username,$password,$dbname);
            
            if(!$con){
                 die('Ket noi that bai:'.mysqli_connect_error());
            }else{
                  mysqli_set_charset($con,'UTF8');
                  $sql = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`users` ( `id` INT(2) NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `phone` VARCHAR(12) NOT NULL , `token` VARCHAR(5) NOT NULL , `password` VARCHAR(32) NOT NULL , `fund` INT(50) NOT NULL , `fund_add` INT(50) NOT NULL , `fund_result` INT(50) NOT NULL , `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql1 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`system` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `port` VARCHAR(2) NOT NULL , `number` VARCHAR(12) NOT NULL , `status` VARCHAR(15) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql2 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`sms` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_user` VARCHAR(11) NOT NULL , `phone` VARCHAR(12) NOT NULL , `port` VARCHAR(2) NOT NULL , `status` VARCHAR(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql3 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`rp_user` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `id_user` INT(5) NOT NULL , `phone` VARCHAR(12) NOT NULL , `lastest_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql4 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`rp_inbox` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `port` INT(5) NOT NULL , `number` VARCHAR(12) NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `content` VARCHAR(5000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql5  = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`rp_final` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `id_user` INT(5) NOT NULL , `sender` VARCHAR(50) NOT NULL , `date` VARCHAR(50) NULL DEFAULT NULL , `money` VARCHAR(50) NOT NULL , `receiver` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB  DEFAULT CHARSET=UTF8;";
                  $sql6 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`recharge` ( `id` INT(3) NOT NULL AUTO_INCREMENT , `phone` VARCHAR(12) NOT NULL , `history_recharge` TIMESTAMP NULL DEFAULT NULL , `content` VARCHAR(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql7 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`inbsent` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_user` INT(11) NOT NULL , `port` VARCHAR(12) NOT NULL , `date` DATE NOT NULL , `time` TIME NOT NULL , `sender` TEXT NOT NULL , `receiver` TEXT NOT NULL , `status` VARCHAR(50) NOT NULL , `note` VARCHAR(1000) NOT NULL , `content` VARCHAR(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql8 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`inbox` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `port` VARCHAR(11) NOT NULL , `number_receiver` VARCHAR(12) NOT NULL, `number_send` VARCHAR(12) NOT NULL , `datetime` DATETIME NOT NULL , `content` VARCHAR(1000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql9 = "CREATE TABLE IF NOT EXISTS `nghia_nhantin`.`sms` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `id_user` VARCHAR(11) NOT NULL , `phone` VARCHAR(12) NOT NULL , `port` VARCHAR(5) NOT NULL , `status` VARCHAR(5000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=UTF8;";
                  
                  $sql10 = "SET time_zone = '+07:00' ";
                        mysqli_query($con, $sql);
                        mysqli_query($con, $sql1);
                        mysqli_query($con, $sql2);
                        mysqli_query($con, $sql3);
                        mysqli_query($con, $sql4);
                        mysqli_query($con, $sql5);
                        mysqli_query($con, $sql6);
                        mysqli_query($con, $sql7);
                        mysqli_query($con, $sql8);
                        mysqli_query($con, $sql9);
                        mysqli_query($con, $sql10);
                        //$sq = "DROP TABLES `users`,`system`,`rp_user`,`rp_final`,`rp_inbox`,`recharge`,`inbsent`,`inbox`, `sms`";mysqli_query($con, $sq);
                        //$sq = "DELETE FROM `nghia_nhantin`.`inbox`";mysqli_query($con, $sq);
                        //$sql = "DELETE * FROM `nghia_nhantin`.`recharge`";mysqli_query($con, $sql);
                        //$sq = "DROP TABLES `inbox`";mysqli_query($con, $sq);
                        /*$sql1 = "INSERT INTO `users`(
                            `id`, `name`, `phone`, `token`, `password`, `fund`, 
                            `fund_add`, `fund_result`, `date`) 
                            VALUES ('1','AT','0976764205','abc','123','5000','0','5000',
                            '2018-06-25 23:57:11')";
                        mysqli_query($con, $sql1);
                        $sqll = "SELECT * FROM users";
                        $r = mysqli_query($con, $sqll);
                        $row = mysqli_num_rows($r);var_dump($row['id']);*/
                	date_default_timezone_set('Asia/Ho_Chi_Minh');
                  //mysqli_close($con);
            }
?>