<?php
          if(!isset($_SESSION)){
              session_start();
              session_destroy();
          }
          if(isset($_SESSION['user']) || isset($_SESSION['message'])){
              unset($_SESSION['user']);
              unset($_SESSION['message']);
              header("Location: dang-nhap.html");
          }
?>