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
        	$id=$_GET['id'];
        	//$id= mysql_real_escape_string($_REQUEST['id']) ;
            //echo "success";
            mysqli_query($link, 'SET CHARACTER SET utf8');
            mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

            $acc=$_SESSION['user'];
            //$nickname_msg=mysqli_query($link, $sql);
            $time=date('Y-m-d G:i:s');
            $msg=$_POST['message'];
            $sql="INSERT INTO product_review(account,product_id,time,text) VALUES('$acc','$id','$time','$msg')";
            
            mysqli_query($link, $sql);
            
            //header("Location:item.php?id=".$id);
            echo " <script language='JavaScript'>history.go(-1);</script>";
        }

?>