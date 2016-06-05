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

            $acc=$_SESSION['user'];
            $a_id=$_POST['res_aid'];
            $time=date('Y-m-d G:i:s');
            $msg = mysql_entities_fix_string($link, $_POST['new_res']);
            $sql="INSERT INTO article_response(account,a_id,time,text) VALUES('$acc','$a_id','$time','$msg')";
            
            mysqli_query($link, $sql);
            $sql="SELECT * FROM article_response WHERE a_id='$a_id'";
            $result=mysqli_query($link,$sql);
            $total_records=mysqli_num_rows($result);

            $page=ceil($total_records/10);

            header("Location:article.php?id=".$a_id."&page=".$page);
            //echo " <script language='JavaScript'>history.go(-1);</script>";
        }

?>