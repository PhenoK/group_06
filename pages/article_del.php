<?php
	include_once('initial.php');
	include_once('connect.php');

	mysqli_query($link,'SET CHARACTER SET utf8');
	mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");
	$time=$_POST['msg_time'];
	$acc_from=$_POST['acc'];
	$acc_log=$_SESSION['user'];
	$a_id=$_POST['a_id'];
	$type=$_POST['type'];

	if($type==1)
	{
		$sql="DELETE FROM article WHERE time='$time' AND account='$acc_from' AND id='$a_id' ";
		$result=mysqli_query($link,$sql);
	}
	
	else
	{
		$sql="DELETE FROM article_response WHERE time='$time' AND account='$acc_from' ";

		$result=mysqli_query($link,$sql);
	}	

	

?>