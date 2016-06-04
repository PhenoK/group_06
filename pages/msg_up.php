<?php
	include_once('initial.php');
	include_once('connect.php');

	$time=$_POST['time'];
	$acc=$_SESSION['user'];
	$newmsg=$_POST['edit_message'];

	if(count(explode(" ", $newmsg)) - 1 >= strlen($newmsg))
	{
		$len=count(explode(" ", $newmsg)) - 1;
		echo "<script language='JavaScript'>alert('請勿輸入空白內容');history.go(-1);</script>";
	}
	else
	{	

		mysqli_query($link,'SET CHARACTER SET utf8');
		mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");
		
		$newtime=date('Y-m-d G:i:s');
		
		$sql="UPDATE product_review SET text='$newmsg' WHERE time='$time' AND account='$acc'";
		
		
		$result=mysqli_query($link,$sql);
		mysqli_free_result($result);
		echo " <script language='JavaScript'>history.go(-1);</script>";
		
	}
?>