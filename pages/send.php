<?php
                
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

            $sql="INSERT INTO member (account,password,name,sex,birth,tel_no,addr,mail,nickname) VALUES ('" .$_POST['account']. "','" . 
            $_POST['pwd'] . "','" . $_POST['user'] . "','" . $_POST['gender']  . "','" . $_POST['birth'] . "','" .
            $_POST['tel'] . "','" . $_POST['addr'] . "','" . $_POST['mail']  . "','" . $_POST['nickname']."')";

            mysqli_query($link, $sql);
            mysqli_close($link);
            header("location:index.php");
        }

?>