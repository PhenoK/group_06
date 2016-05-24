<!DOCTYPE html>
<html lang="en">

<head>
	<title>元經樵 - 會員登入</title>

	<?php include 'head.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="additional-methods.min.js"></script>

	<!--additional method - for checkbox .. ,require_from_group method ...-->
	<script>
	$(document).ready(function($) {
		
		jQuery.validator.addMethod("noSpace", function(value, element) {
					return value.indexOf(" ") < 0;
		}, "請勿輸入空格");

		jQuery.validator.addMethod("chEn", function(value, element) {
					return this.optional(element) || /^[A-Za-z\u4e00-\u9fa5]+$/.test(value);
		}, "只能輸入中/英文");

		jQuery.validator.addMethod("enNum", function(value, element) {
    			return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
		}, "只能輸入英文、數字");
	

			$("#form_sI").validate({
					submitHandler: function(form) {
							alert("登入成功!");
							form.submit();
					},

					rules: {
							account: {
									required: true,
									minlength: 6,
									maxlength: 12,
									noSpace:true,
									chEn:true,
									

							},
							password: {
									required: true,
									minlength: 6,
									maxlength: 12
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

					}
			});

	});
	</script>
	<style>
	.panel-height {
			height: 300px;
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

		<div >
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
																				<label class="col-md-2 col-md-offset-1" for="account">帳號</label>
																				<div class="col-md-7">
																						<input class="form-control" placeholder="限6~12個字元" id="account" name="account" type="text" autofocus>
																				</div>
																		</div>
																</div>
																<div class="form-group">
																		<div class="row">
																				<label class="col-md-2 col-md-offset-1" for="password">密碼</label>
																				<div class="col-md-7">
																						<input class="form-control" placeholder="限6~12個字元" id="password" name="password" type="password" value="" autofocus>
																				</div>
																		</div>
																</div>
																<div class="row">
																		<div class="col-md-offset-3">
																				<div class="checkbox">
																						<label>
																								<input name="remember" type="checkbox" value="Remember Me">保持今日登入狀態
																						</label>
																				</div>
																		</div>
																</div>
																<!-- Change this to a button or input when using this as a form -->
																<div class="form-group">
																		<div class="row">
																				<button type="submit" class="btn btn-lg btn-success col-md-6 col-md-offset-3" style="margin-bottom:5px;">登入</button>
																				<a href="signUp.php" class="btn btn-primary col-md-4 col-md-offset-1">加入會員</a>
																				<a href="forget.php" class="btn btn-warning col-md-4 col-md-offset-2">忘記密碼</a>
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
