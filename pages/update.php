<?php
     include ('initial.php');        
       include('connect.php');    

        if (!$link ) {
            echo "連結錯誤代碼: ".mysqli_connect_errno()."<br>";
            echo "連結錯誤訊息: ".mysqli_connect_error()."<br>";
            exit();
        }
        else
        {
            echo "success";
            mysqli_query($link, 'SET CHARACTER SET utf8');
            mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
            $account = $_SESSION['user'];
            $user =  $_POST['user'] ;
            $sex = $_POST['gender'] ;
            $birth = $_POST['birth'];
            $tel =  $_POST['tel'];
            $mail = $_POST['mail'];
            $addr = $_POST['addr'];
            $nickname =  $_POST['nickname'];
            $pass = $_POST['pass'];
            $pwd = $_POST['pwd'];
            if($pwd == null)
             {
                 $sql="UPDATE member SET name = '$user',sex = '$sex',birth = '$birth',tel_no = '$tel',addr = '$addr',mail = '$mail',nickname = '$nickname' where account = '$account'";
                 header("location:AccountInformation.php");  
               
             }   
             else
             {
                $sql="UPDATE member SET name = '$user',password = '$pwd',sex = '$sex',birth = '$birth',tel_no = '$tel',addr = '$addr',mail = '$mail',nickname = '$nickname' where account = '$account'";
                 header("location:AccountInformation.php");  
             }
            
            
            mysqli_query($link, $sql);
            mysqli_close($link);
            //header("location:AccountInformation.php");
        }

?>