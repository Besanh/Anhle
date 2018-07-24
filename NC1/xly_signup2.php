<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    echo now();
    echo date('d/m/Y H:i:s');
    $format = "%H:%M:%S";
    $timestamp = time();
    echo $strTime = strftime($format, $timestamp );
?>
