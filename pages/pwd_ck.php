<?php 
   $pass = trim(@($_POST['pass'])); 
   $pwd = trim(@($_POST['pwd'])); 
   if($pwd == null)
   	  echo"";
   else if($pass == null)
   	 echo "請輸入密碼!"; 

   


?>