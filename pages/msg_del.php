<?php
	include_once('initial.php');
	include_once('connect.php');

	$time=$_POST['msg_time'];
	$acc_from=$_POST['acc'];
	$acc_log=$_SESSION['user'];


	$sql="DELETE FROM product_review WHERE time='$time' AND account='$acc_from' ";
	
	mysqli_query($link,'SET CHARACTER SET utf8');
	mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");
	$result=mysqli_query($link,$sql);
	mysqli_free_result($result);

?>