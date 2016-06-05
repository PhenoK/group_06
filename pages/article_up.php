<?php
	include_once('initial.php');
	include_once('connect.php');

	$time=$_POST['time'];
	$acc=$_SESSION['user'];

	$newmsg=mysql_entities_fix_string($link,$_POST['edit_message']);
	$type=$_POST['type'];
	$a_id=$_POST['a_id'];
	$new_time=date('Y-m-d G:i:s');

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
		
		if($type==1)
		{
			$sql="UPDATE article SET text='$newmsg',edit_time='$new_time' WHERE time='$time' AND account='$acc' AND id='$a_id'";
		}
		else
		{
			$sql="UPDATE article_response SET text='$newmsg',edit_time='$new_time' WHERE time='$time' AND account='$acc' AND a_id='$a_id'";
		}
		
		
		$result=mysqli_query($link,$sql);

		
		echo " <script language='JavaScript'>history.go(-1);</script>";
		
	}
?>