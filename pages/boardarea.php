<?php
	include_once('initial.php');
	include_once('connect.php');
	if(@$_GET['page'])
	  $page=$_GET['page'];
	else
	  $page=1;

	if(@$_GET['devision'])
	  $devide=$_GET['devision'];
	else
	  $devide=10;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  	<title>公告留言區</title>
  	<?php include 'head.php'; ?>
  	<!-- Latest compiled and minified CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
	
  	<!-- Latest compiled and minified JavaScript -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	
  	<!-- (Optional) Latest compiled and minified JavaScript translation files -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>
  	<script>
  		$(document).ready(function($) {
  			/* table row color */
  		    $(".tr_hover0").addClass('info');
  		    $(".tr_hover1").addClass('active');
  		    $(".tr_hover2").addClass('success');
  		    $(".tr_hover3").addClass('warning');
  		    $(".tr_hover4").addClass('danger');

  		    /* lead to article */
  		    $(".clickable-row").click(function() {
	
  		        window.document.location = $(this).data("href");
	
  		    });

  		    /* select page devide */
  		    $(".selectpicker").on("change",function(){
  		    	//var page=$(this).get(0).id;
  		    	var selected = $(this).find("option:selected").val();
  		    	$(this).attr("devision",selected);
  		    	var devide = $(this).attr("devision");
  		    	//alert(selected);
  		    	//alert(devide);
  		    	window.location.href = "boardarea.php?page=1"+"&devision="+devide;
  		    });

  		    $(".back").click(function() {
  		    
  		        window.parent.frames.location.href="index.php";
  		    
  		    });

  		    $(".unlogged").click(function() {
  		    
  		        window.parent.frames.location.href="signIn.php";
  		    
  		    });

  		    /*$(window.parent.document).find("#main").load(function(){
  		    	var main = $(window.parent.document).find("#main");
  		    	var thisheight = $(document).height()+100;
  		    	main.height(thisheight);
  		    });*/
  		
  		});

  	</script>
  	<style>

  		.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  		   cursor: pointer;
  		}

  		  pre.cell {
  		    border:none;
  		}

  	</style>
</head>
<body>

	<div class="board_area">
		<div class="row col-md-12" style="margin-bottom: 10px;">
			<div class="col-md-4 pull-left">
				<select class="selectpicker" multiple title="單頁文章數" devision="<?=$_GET['devision']?>" id="<?=$page?>" name="select_page" data-width="fit">
					<option value="10">10筆</option>
					<option value="15">15筆</option>
					<option value="20">20筆</option>
					<option value="30">30筆</option>
					<option value="40">40筆</option>
				</select>
			</div>
			<div class="pull-right">
				<?php
					if(isset($_SESSION['user']))
					{
						echo "<a href='article_create.php' class='btn btn-info' role='button'>發表文章</a>";
					}
					else
					{
						echo "<a  class='btn btn-info unlogged' role='button'>登入發表文章</a>";
					}
				?>
				
			</div>
			
		</div>
		<table class="table table-condensed table-hover table-responsive">
			<thead>
				<tr class="success">
					<th class="col-md-2 text-center">發表時間</th>
					<th class="col-md-2 text-center">最後編輯時間</th>
					<th class="col-md-5 text-center">標題</th>
					<th class="col-md-1 text-center">作者</th>
				</tr>
			</thead>
			<tbody>
				
				<?php

					$sql="SELECT * FROM article ORDER BY edit_time DESC";
					if($result=mysqli_query($link,$sql))
					{
						$total_records=mysqli_num_rows($result);

						if($total_records!=0)
						{

							$total_page=ceil($total_records/$devide);

							mysqli_data_seek($result,($page-1)*$devide);
							
							for($i=1;$i<=$devide;$i++)
							{
								$row=mysqli_fetch_assoc($result);
								$tr_class=$i%5;
								if( $i <= $total_records &&  $total_records-($page-1)*$devide-$i>=0)
								{

									
									echo "
											<tr class='clickable-row tr_hover".$tr_class."' data-href='article.php?id="
												.$row['id']."&page=1'>
												<td>".$row['time']."</td>
												<td>".$row['edit_time']."</td>
												<td>".$row['title']."</td>
												<td>".$row['account']."</td>
											</tr>
										";
								}
								else
									break;
								
							}

						}
					}
					
					

				?>
			</tbody>
		</table>

		<div style="margin-bottom:60px">
		    <pre class="cell"></pre>
		</div>

		<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
			<div class="text-center">
				<a class="btn btn-info back" href='index.php'><i class='fa fa-reply ' aria-hidden='true'></i>回首頁</a>
			    <?php
			        if($total_records!=0)
			        {
			            for($i=1;$i<=$total_page;$i++)
			            {
			                if($i==$page)
			                    echo"<a class='btn btn-primary' id='cur'>".$i."</a>";
			                else
			                    echo "<a class='btn btn-info'"."href='boardarea.php?page=".$i."&devision=".$devide."'>".$i."</a>";
			            }
			        }
			        
			
			    ?>
			</div>
		</nav>
	</div>
	
</body>
