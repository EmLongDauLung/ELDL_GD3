<?php
    $img = $_GET['img'];
    // echo"../../../../../../etc/passwd";
    // $file_path = '/var/www/eldl/html/assets/img/' . $img;
    $file_path = '/var/www/eldl/html/assets/img/' . $img;
    if(file_exists($file_path)){
        readfile($file_path);
    }
    else{
        echo"404 Not Found";
    }
?>