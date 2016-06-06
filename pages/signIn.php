<?php
include_once 'initial.php';
include_once 'connect.php';
$error = $user = $pwd = "";

// 成功送出表單
if (isset($_POST['account'])){
  $user = $_POST['account'];
  $pwd = $_POST['password'];

  // 利用取得的值驗證是否登入成功
  $sql = "SELECT * FROM member WHERE account = '$user' AND password = '$pwd'";

  $result = mysqli_query($link, $sql);
  // 若取得資料數0筆 => 無吻合
  if (($num=mysqli_num_rows($result)) == 0){
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
      var tmp = document.getElementById("error");
			tmp.className += " alert alert-danger";
      tmp.innerHTML = "<i class=\"fa fa-times-circle fa-fw\"></i>帳號或密碼錯誤！<i class=\"fa\"></i>";
    });
    </script>
    <?php
  }
  else {
    // 登入成功，設定登入狀態session
    $_SESSION['user'] = $user;

    $row = mysqli_fetch_assoc($result);
    // 設定使用者等級session
    $_SESSION['level'] = $row['level'];
    echo " <script language='JavaScript'>history.go(-2);</script>";
  }
}


// 點下登出按鈕將會以GET傳送action=logout
if (isset($_GET['action'])){
  $action = $_GET['action'];

  // 若要登出 && 真有SESSION登入狀態
  if ($action == "logout" && isset($_SESSION['user'])){
    // 解除session
    unset($_SESSION['user']);
    unset($_SESSION['level']);
    echo " <script language='JavaScript'>history.go(-1);</script>";
  }
}
else if (isset($_SESSION['user'])){
  // 若來到此網頁，但已有session狀態，導向到首頁
  echo " <script language='JavaScript'>history.go(-1);</script>";

  // 可是!!登入成功後，無法回到登入前的頁面，似乎是if流程來到原本導向首頁的此處
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>元經樵 - 會員登入</title>

	<?php include 'head.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="additional-methods.min.js"></script>

	<!--additional method - for checkbox .. ,require_from_group method ...-->
	<script>
	$(document).ready(function() {

		jQuery.validator.addMethod("noSpace", function(value, element) {
					return value.indexOf(" ") < 0;
		}, "請勿輸入空格");

		jQuery.validator.addMethod("enNum", function(value, element) {
    			return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
		}, "只能輸入英文、數字");


			$("#form_sI").validate({
					submitHandler: function(form) {
						if($num!=0)
							form.submit();
					},

					rules: {
							account: {
									required: true,
									minlength: 6,
									maxlength: 12,
									noSpace:true,


							},
							password: {
									required: true,
									minlength: 6,
									maxlength: 12,
									noSpace:true
							},

					},
					messages: {
							account: {
									required: "帳號為必填欄位",
									minlength: "帳號最少要6個字",
									maxlength: "帳號最長12個字"
							},
							password: {
									required: "密碼為必填欄位",
									minlength: "密碼最少要6個字",
									maxlength: "密碼最長12個字"
							},

					},

					errorPlacement: function(error, element) {

					    var eid = element.attr('name');
					    $('input[name=' + eid + ']').after(error);
					},
			});

	});
	</script>
	<style>
	.error {
	    color: #D82424;
	    font-weight: normal;
	    font-family: "微軟正黑體";
	    display: block;
	    padding: 1px;
	}
	.panel-body {
			word-break: break-all
	}
	</style>
</head>

<body>
	<div id="wrapper">
		<?php include 'navbarTop.php'; ?>
	  </nav>
		<div>
        <div id="error"></div>
				<div class="row">
						<div class="col-md-4 col-md-offset-4">
								<div class="login-panel panel panel-primary">
										<div class="panel-heading">
												<h3 class="panel-title" style="text-align: center;">元經樵屋頂拍賣會員登入</h3>
										</div>
										<div class="panel-body panel-height">
												<form class="form-horizontal" role="form" method="POST" id="form_sI">
															<fieldset>
																<div class="form-group">
																		<div class="row">
																				<label class="col-md-2 col-sm-offset-1" for="account">帳號</label>
																				<div class="col-md-6">
																						<input class="form-control" placeholder="限6~12個字元" id="account" name="account" type="text" autofocus>
																				</div>
																		</div>
																</div>
																<div class="form-group">
																		<div class="row">
																				<label class="col-md-2 col-sm-offset-1" for="password">密碼</label>
																				<div class="col-md-6">
																						<input class="form-control" placeholder="限6~12個字元" id="password" name="password" type="password" value="" autofocus>
																				</div>
																		</div>
																</div>

																<!-- Change this to a button or input when using this as a form -->
																<div class="form-group">
																		<div class="row">
																				<button type="submit" class="btn btn-lg btn-success col-md-4 col-sm-offset-4" style="margin-bottom:5px;">登入</button>
																				<a href="signUp.php" class="btn btn-primary col-md-4 col-md-offset-4">加入會員</a>
																		</div>
																</div>
														</fieldset>
												</form>
										</div>
								</div>
						</div>
				</div>
		</div>
		<!-- /#wrapper -->

		<?php include 'footer.php'; ?>

		<!-- Bootstrap Core JavaScript -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- Custom Theme JavaScript -->
		<script src="../js/sb-admin-2.js"></script>
</body>
</html>
