<?php
include_once('initial.php');
include_once('connect.php');

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>留言板</title>
  <?php include 'head.php'; ?>

</head>

<body data-spy="scroll" data-target=".navbar">
	
	<div id="wrapper">
		<?php include 'navbarTop.php'; ?>
	  	<?php include 'navbarSide.php'; ?>
	  	<?php

	  		include_once('connect.php');
	  		mysqli_query($link, "SET CHARACTER SET utf8");
	  		mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

			
			if(@$_GET['page'])
			  $page=$_GET['page'];
			else
			  $page=1;

			if(@$_GET['devision'])
			  $devide=$_GET['devision'];
			else
			  $devide=10;  		

	  	?>

	  	<div id="page-wrapper">
	  		<div class="container">
	  			<div class="row">
	  				<!----> 
	  				<div class="embed-responsive embed-responsive-16by9" scrolling="auto">
	  					<iframe id="main" width="98%" frameborder="0" scrolling="auto" src="boardarea.php?page=<?=$page?>&devision=<?=$devide?>">
	  					</iframe>	
	  				</div>
	  			</div>
	  		</div>
	  	</div>
	  	<!-- page-wrapper -->
	</div>
	<!-- /#wrapper -->

  <?php include 'footer.php'; ?>

</body>

</html>
