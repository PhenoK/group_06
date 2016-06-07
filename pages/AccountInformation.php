<?php
include 'initial.php';
include 'connect.php';

if(!$logged)
    header("location:signIn.php");


 ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>元經樵 - 會員資料</title>
        <?php include 'head.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <script type="text/javascript"  src="additional-methods.min.js"></script>
            <script>

            $(document).ready(function($) {

                jQuery.validator.addMethod("isDate", function(value, element) {
                    var ereg = /^(\d{1,4})(-|\/)(\d{1,2})(-|\/)(\d{1,2})$/;
                    var r = value.match(ereg);
                    if (r == null) {
                        return false;
                    }
                    var d = new Date(r[1], r[3] - 1, r[5]);
                    var result = (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[5]);
                    return this.optional(element) || (result);
                }, "請輸入正確的日期");

                jQuery.validator.addMethod("noSpace", function(value, element) {
                    return value.indexOf(" ") < 0;
                }, "請勿輸入空格");

                jQuery.validator.addMethod("chEn", function(value, element) {
                    return this.optional(element) || /^[A-Za-z\u4e00-\u9fa5]+$/.test(value);
                }, "只能輸入中/英文");

                jQuery.validator.addMethod("ch", function(value, element) {
                    return this.optional(element) || /^[\u4e00-\u9fa5]+$/.test(value);
                }, "只能輸入中文");


                jQuery.validator.addMethod("enNum", function(value, element) {
                    return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
                }, "只能輸入英文、數字");

                jQuery.validator.addMethod("Num", function(value, element) {
                    return this.optional(element) || /^[0-9]+$/.test(value);
                }, "只能輸入數字");

                $("#form_sU").validate({
                    submitHandler: function(form) {
                        alert("修改成功");
                        $(form).ajaxSubmit({
                            type: "POST",
                            url: "update.php",
                            dataType: "text",
                            data: $('#form_sU').serialize(),

                        });

                    },

                    errorPlacement: function(error, element) {

                        if (element.is(':radio') || element.is(':checkbox')) {
                            var eid = element.attr('name');
                            $('input[name=' + eid + ']:last').next().after(error);
                        } else {
                            error.insertAfter(element);
                        }
                    },

                    rules: {

                       pass: {
                            remote: {
                                url: "pass_ck.php",
                                type: "POST",
                                data: {
                                    pass: function() {
                                        return $("#pass").val();
                                    }
                                }
                            },
                            required: true,
                            noSpace: true,
                            enNum: true,
                        },
                        pwd: {

                            minlength: 6,
                            maxlength: 12,
                            noSpace: true,
                            enNum: true,
                        },
                        pwd_ck: {

                            minlength: 6,
                            maxlength: 12,
                            equalTo: "#pwd",
                        },
                        user: {
                            required: true,
                            maxlength: 5,
                            chEn: true,
                            noSpace: true,
                        },
                        gender: {
                            required: true,
                        },
                        birth: {
                            required: true,
                            isDate: true,
                            noSpace: true,
                        },
                        tel: {
                            maxlength: 20,
                            noSpace: true,
                            Num: true,

                        },
                        addr: {
                            noSpace: true,
                        },
                        mail: {
                            required: true,
                            email: true,
                            noSpace: true
                        },
                        nickname: {
                            required: true,
                            maxlength: 10,
                            noSpace: true,
                        }

                    },
                    messages: {

                        pass: {
                            required: "密碼為必填欄位",
                            remote: "密碼輸入錯誤",
                        },
                        pwd: {
                            remote: "請輸入密碼",
                            minlength: "密碼最少要6個字",
                            maxlength: "密碼最長12個字",
                        },
                        pwd_ck: {
                            minlength: "密碼最少要6個字",
                            maxlength: "密碼最長12個字",
                            equalTo: "與密碼不符",
                        },
                        user: {
                            required: "姓名為必填欄位",
                            maxlength: "姓名最長5個字",
                        },
                        gender: {
                            required: "請選擇性別",
                        },
                        birth: {
                            required: "請輸入生日(YYYY/MM/DD)",
                        },
                        tel: {
                            maxlength: "長度最長20字",
                        },
                        mail: {
                            required: "請輸入電子郵件",
                            email: "格式不合",
                        },
                        nickname: {
                            required: "請輸入暱稱",
                            maxlength: "長度最長10個字",
                        }
                    }
                });

            });

            </script>
            <style type="text/css">
            .error {
                color: #D82424;
                font-weight: normal;
                font-family: "微軟正黑體";
                display: block;
                padding: 1px;
            }



            .table-bordered > tbody > tr > td,
            .table-bordered > tfoot > tr > th {
                font-color: rgb(0, 0, 204);
                font-family: "微軟正黑體";
            }

            textarea {
                resize: none;
            }
            </style>
    </head>

    <body>
    <?php
        $user = $_SESSION['user'];
        $sql = "SELECT * FROM member where account = '$user'";
        $result = mysqli_query($link, $sql);
        if ( $result = mysqli_query($link, $sql) )
        {

            $row = mysqli_fetch_assoc($result);
            $acc = $row["account"];
            $name = $row["name"];
            $sex =$row["sex"];
            $birth = $row["birth"];
            $tel = $row["tel_no"];
            $addr = $row["addr"];
            $mail = $row["mail"];
            $nickname = $row["nickname"];

        mysqli_free_result($result);
        }
        mysqli_close($link);

    ?>
        <div id="wrapper">
            <?php include 'navbarTop.php'; ?>
            </nav>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">會員資料</div>
                        <div class="panel-body panel-height">
                            <form class="form-horizontal" role="form" method="POST" id="form_sU" action="update.php">
                                <fieldset>
                                    <div class="form-group">
                                        <table class="table table-bordered col-md-8 col-md-offset-1" style="margin:auto;">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="account">帳號</label>
                                                    </td>
                                                    <td class="col-md-6 col-md-offset-2">
                                                      <?php echo"$acc";?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="account">密碼</label>
                                                    </td>
                                                    <td class="col-md-6 col-md-offset-2">
                                                        <input type="password" class="form-inline col-md-4 col-md-offset-1" id="pass" name="pass" ><span id="pass_msg" style="color:red;"></span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="pwd">更改密碼</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" class="form-inline col-md-4 col-md-offset-1" id="pwd" name="pwd" placeholder="限6-12個字" onkeyup="sendRequest()">
                                                        <span id='show_msg' style="color:red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="pwd_ck">新密碼確認</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" class="form-inline col-md-4 col-md-offset-1" id="pwd_ck" name="pwd_ck" placeholder="請再次輸入密碼">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="user">姓名</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="user" name="user" value="<?php echo"$name";?>"　placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="gender">姓別</label>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-1"></div>
                                                        <?php  if($sex == "M"){?>
                                                        <input class="form-inline col-md-1" type="radio" id="gender" name="gender" value="M" checked>
                                                        <label class="pull-left">男 性</label>
                                                        <?php  }   else{?>
                                                        <input class="form-inline col-md-1" type="radio" id="gender" name="gender" value="M">
                                                        <label class="pull-left">男 性</label>
                                                        <?php  } if($sex == "F"){?>
                                                        <div class="col-md-1"></div>
                                                        <input class="form-inline col-md-1" type="radio" id="gender" name="gender" value="F" checked>
                                                        <label class="pull-left">女 性</label>
                                                        <?php }    else{?>
                                                        <input class="form-inline col-md-1" type="radio" id="gender" name="gender" value="F">
                                                        <label class="pull-left">女 性</label>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="birth">生日</label>
                                                    </td>
                                                    <td>
                                                        <input type="ptext" class="form-inline col-md-4 col-md-offset-1" id="birth" name="birth" value="<?php echo"$birth";?>" placeholder="例:1999/09/01">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="tel">電話號碼</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="tel" name="tel" value="<?php echo"$tel";?>"    placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="addr">地址</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="addr" name="addr" value="<?php echo"$addr";?>" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="mail">電子郵件</label>
                                                    </td>
                                                    <td>
                                                        <input type="mail" class="form-inline col-md-4 col-md-offset-1" id="mail" name="mail" value="<?php echo"$mail";?>" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="nickname">暱稱</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="nickname" name="nickname"  value="<?php echo"$nickname";?>" placeholder="">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-2 col-sm-offset-3">
                                                 <label>
                                                    <button type="submit" class="btn btn-primary " >確定修改</button>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <!-- Bootstrap Core JavaScript -->
        <!-- Latest compiled and minified JavaScript -->

        <!-- Custom Theme JavaScript -->
        <script src="../js/sb-admin-2.js"></script>
    </body>

    </html>
