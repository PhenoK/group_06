<!DOCTYPE html>
<html lang="en">

<head>
    <title>元經樵 - 密碼查詢</title>
    <?php include 'head.php'; ?>

<body>
  <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    <?php include 'navbarSide.php'; ?>
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-primary" style="margin-top: 10px;">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align: center;">查詢密碼</h3>
                    </div>
                    <div class="panel-body panel-height">
                        <form class="form-horizontal" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-2 col-md-offset-2" for="account" style="text-align: right;">帳號</label>
                                        <div class="col-md-5">
                                            <input class="form-control" placeholder="請輸入帳號" id="account" name="account" type="text" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-2 col-md-offset-2" for="cellphone" style="text-align: right;">手機號碼</label>
                                        <div class="col-md-5">
                                            <input class="form-control" placeholder="請輸入手機號碼" id="cellphone" name="cellphone" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-3">
                                        注意事項:
                                        <br> 1.若您註冊手機已更換，請至「更換原手機號碼」進行變更。
                                        <br> 2.如您查詢密碼過程中有任何問題，請直接與客服中心聯絡。
                                    </div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-4">
                                        <label>
                                            <button type="submit" class="btn btn-primary">確定送出</button>
                                        </label>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-1">
                                        <label>
                                            <button type="reset" class="btn btn-warning">重新填寫</button>
                                        </label>
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
</body>

</html>
