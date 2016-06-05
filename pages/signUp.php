<?php
include_once 'initial.php';


if ($logged){
  header('Location: index.php');
}


 ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>元經樵 - 會員註冊</title>
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
                        alert("註冊成功!");

                        $(form).ajaxSubmit({
                            type: "POST",
                            url: "send.php",
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
                        account: {
                            remote: {
                                url: "acc_ck.php",
                                type: "POST",
                                data: {
                                    account: function() {
                                        return $("#account").val();
                                    }
                                }
                            },
                            required: true,
                            minlength: 6,
                            maxlength: 12,
                            noSpace: true,
                            enNum: true,
                        },
                        pwd: {
                            required: true,
                            minlength: 6,
                            maxlength: 12,
                            noSpace: true,
                            enNum: true,
                        },
                        pwd_ck: {
                            required: true,
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
                        },
                        agree: {
                            required: true
                        }



                    },
                    messages: {
                        account: {
                            remote: "此帳號已存在",
                            required: "帳號為必填欄位",
                            minlength: "帳號最少要6個字",
                            maxlength: "帳號最長12個字",
                        },
                        pwd: {
                            required: "密碼為必填欄位",
                            minlength: "密碼最少要6個字",
                            maxlength: "密碼最長12個字",
                        },
                        pwd_ck: {
                            required: "請再次輸入密碼",
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
                        },
                        agree: {
                            required: "請詳閱會員合約並勾選同意"
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
            
            
            
            .table{
                margin: auto;
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
        <div id="wrapper">
            <?php include 'navbarTop.php'; ?>
            </nav>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">會員資料填寫</div>
                        <div class="panel-body panel-height">
                            <form class="form-horizontal" role="form" method="POST" id="form_sU" action="send.php">
                                <fieldset>
                                    <div class="form-group">
                                        <table class="table table-bordered col-md-8 col-md-offset-1">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="account">帳號</label>
                                                    </td>
                                                    <td class="col-md-6 col-md-offset-2">
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="account" name="account" placeholder="限6-12個字"><span id="acc_msg" style="color:red;"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="pwd">密碼</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" class="form-inline col-md-4 col-md-offset-1" id="pwd" name="pwd" placeholder="限6-12個字">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="pwd_ck">密碼確認</label>
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
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="user" name="user" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="gender">姓別</label>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-1"></div>
                                                        <input class="form-inline col-md-1" type="radio" id="gender" name="gender" value="M">
                                                        <label class="pull-left">男 性</label>
                                                        <div class="col-md-1"></div>
                                                        <input class="form-inline col-md-1" type="radio" id="gender" name="gender" value="F">
                                                        <label class="pull-left">女 性</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="birth">生日</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="birth" name="birth" placeholder="例:1999/09/01">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="tel">電話號碼</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="tel" name="tel" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="addr">地址</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="addr" name="addr" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="mail">電子郵件</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="mail" name="mail" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">
                                                        <label for="nickname">暱稱</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-inline col-md-4 col-md-offset-1" id="nickname" name="nickname" placeholder="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-1 col-md-offset-3 text-right">同意會員合約</td>
                                                    <td>
                                                        <textarea class="form-inline col-md-8 col-md-offset-1" id="contract" name="contract" readonly="">
                                                            元經樵屋頂拍賣服務（以下稱「本服務」）是由「元經樵市集國際資訊股份有限公司」（以下稱「元經樵」）所建置及提供之服務，所有使用本服務的使用者（以下稱「會員」），都應詳細閱讀下列約定條款，以下服務約定條款構成會員與元經樵間之合約，會員完成註冊、或開始使用本服務時，即視為會員已閱讀、暸解、並同意以下所有約定條款的所有內容：一、會員合約 1.除本文件所約定之內容外，元經樵已經公佈及將來可能公佈之使用規範、辦法、處理原則、政策、及相關服務說明等，均為會員合約的一部份；會員除須同意並遵守本文件所約定之內容外，並應同意並遵守該等已經公佈及將來可能公佈之使用規範、辦法、處理原則、政策、及相關服務說明。 二、會員及註冊 1.會員必須是具備完全行為能力的自然人、或合法登記的法人或團體。若會員為未成年人，應由其法定代理人閱讀、暸解、並同意會員合約之所有約定內容及其修改後之內容，始得開始使用或繼續使用本服務；如會員開始使用或繼續使用本服務，即推定其法定代理人已閱讀、暸解、並同意會員合約之所有約定內容及其修改後之內容。 三、網路交易平台服務 1.元經樵僅提供網路交易平台服務，供會員自行刊載物件及進行交易。 。 四、費用： 1.刊載於元經樵之物件成交後，應依當時所定之「元經樵成交手續費收費辦法」支付成交手續費。 五、行為規範： 1.會員使用元經樵之相關服務及功能時，應使用自己之會員帳號及密碼登入系統，不得以任何方式轉讓或授權他人使用自己之會員帳號（包括信用評價）。 六、停權及終止： 1.元經樵發現、或接獲第三人之檢舉或通知，認為會員之行為、交易、或其所刊載之相關物件或訊息，有違背法令或公序良俗、或侵害第三人之權益、或違反會員合約或其相關規範或規則之虞者，為維護元經樵及第三人之權益、或避免損害或爭議擴大，元經樵得不經事先通知，先行移除所涉及之物件或資料、或使之無法被存取，並得暫停該會員所能使用之服務或功能之全部或一部，且得取消其會員資格、終止會員合約；其涉及違反法令者，並得主動將會員資料及相關交易資料或資訊，移送相關司法機關調查，或依法配合相關司法機關調查。 七、系統維護及服務中斷： 1.元經樵將盡力維護本服務系統之正常運作，使會員之交易活動得以順利進行，但本服務僅依其現況提供服務，對於下列事項，元經樵不負任何明示或默示之承諾或保證： 　　a.符合會員之特定需求； 　　b.系統及軟體得以不受干擾地持續運作； 　　c.資料得以被即時、正確無誤地傳輸、處理、儲存及備份； 　　d.系統、軟體及資料之錯誤，將被即時發現及更正。 八、授權 1.會員上載、傳送或提供物件資料或其他相關資料至元經樵時，視為會員已同意授權元經樵得利用、儲存及刊載該等資料，以供特定或不特定之使用者搜尋及瀏覽，並得經由平面或電子形式，重製、散布、公開播送、公開上映、改作、編輯、公開發行、公開發表、或公開傳輸該等資料，並得將該等權利轉授權予第三人。會員上載、傳送或提供物件資料或其他相關資料至元經樵時，應擔保其有上載、傳送或提供該等資料之權利，且得授權元經樵利用、儲存、刊載、供特定或不特定之使用者搜尋及瀏覽、重製、散布、公開播送、公開上映、改作、編輯、公開發行、公開發表、或公開傳輸該等資料，且得將該等權利轉授權予第三人。 九、責任限制： 1.因下列情形所致之服務暫停或中斷、交易無法進行、資料遺失或毀損、或其他因此所生之所有直接或間接損害，除因元經樵之故意或重大過失所致者外，元經樵不負賠償責任 十、準據法及管轄： 1.本會員合約及其相關使用規範、辦法、處理原則、政策、及相關服務說明等，以中華民國法令為準據法。 2.會員與元經樵間因本服務、本會員合約或其相關使用規範、辦法、處理原則、政策、及相關服務說明所生之爭議，如因此而訴訟，以台灣台北地方法院為第一審管轄法院。
                                                        </textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-md-offset-3">
                                            <input class="form-inline col-md-1" id="agree" name="agree" type="checkbox" value="agree">
                                            <label class="form-inline col-md-5">同意會員合約。</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-2 col-sm-offset-3">
                                                <label>
                                                    <button type="submit" class="btn btn-primary">資料送出</button>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 col-sm-offset-1">
                                                <label>
                                                    <button type="reset" class="btn btn-warning">重新填寫</button>
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../js/sb-admin-2.js"></script>
    </body>

    </html>
