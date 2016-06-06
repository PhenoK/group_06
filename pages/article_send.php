<?php
       include_once('initial.php');
       include('connect.php');    

        if (!$link ) {
            echo "連結錯誤代碼: ".mysqli_connect_errno()."<br>";
            echo "連結錯誤訊息: ".mysqli_connect_error()."<br>";
            exit();
        }
        else
        {
            mysqli_query($link, 'SET CHARACTER SET utf8');
            mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

            $title=$_POST['title'];
            $text = mysql_entities_fix_string($link, $_POST['content']);
            $acc=$_SESSION['user'];

            $time=date('Y-m-d G:i:s');

            $sql="INSERT INTO article(account,title,time,edit_time,text) VALUES('$acc','$title','$time','$time','$text')";
            
            mysqli_query($link, $sql);
            
            header("Location:boardarea.php");

        }

?>