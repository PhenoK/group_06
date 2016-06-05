<?php
include_once 'initial.php';
include_once 'connect.php';
if (!$logged){
  header('Location: signIn.php');
}

// 消費者帳號
$account = @$_GET['account'];

// 若亂看別人的訂單
if ($_SESSION['user'] != $account){
  header('Location: index.php');
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>元經樵 - 購物車</title>
  <?php include 'head.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

  <script>
  function payForOrder(b_id){
    if (!confirm("確定付款？本店絕不退錢！")){
        return false;
    }
    $.ajax({
      url: 'payForOrder_ajax.php',
      data: {
        id: b_id
      },
      type: 'POST',
      dataType: "text",
      success: function(text) {
        if (text.indexOf("成功")){
          alert(text);
          location.reload();
        }
        else {
          alert(text + "gfg");
          return;
        }

      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert("付款失敗！");
        alert(thrownError);
      }
    });
  }

  </script>

  <!-- creditForm -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta property="og:url" content="http://jquerycreditcardvalidator.com">

  <link rel="canonical" href="http://jquerycreditcardvalidator.com/">


  <link rel="stylesheet" href="../css/creditForm.css">

  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="../js/creditForm.js"></script>

  <script type="text/javascript">
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-12777986-11', 'auto');
      ga('send', 'pageview');
  </script>

  <style>
  /*hightlight 訂單label*/
    .hl_order_tb {
      text-decoration: underline;
      font-weight: bold;
    }
  </style>
</head>

<body>
 <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    </nav>

    <!-- shopping list Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            <label class="label label-success"><i class="fa fa-list fa-fw"></i> 購物記錄</label>
          </h1>
        </div>
      </div>

      <!-- total order_list Row -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            $sql = "SELECT * FROM order_list, order_product, product
                  WHERE order_list.account = '$account'
                  AND order_list.id = order_product.id
                  AND order_product.product_id = product.id";
            if ($result = mysqli_query($link, $sql)){
              // 取出資料數
              $tb_rec = mysqli_num_rows($result);
              // 若沒資料就不用顯示了
              if ($tb_rec == 0){
                die("目前尚無訂單資料唷！");
              }

              // 先取出一筆
              $row = mysqli_fetch_array($result, MYSQLI_BOTH);
              // 顯示完一筆單號後，檢查fetch是否有取到資料，若沒有就是沒訂單了
              while ($row){
                // 取得單號
                $b_id = $row[0];
                $arr_bId[] = $b_id;
                if ($row['pay'] == 1)
                  $pay = "是";
                else
                  $pay = "否";
                ?>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <p>
                <span class="hl_order_tb">訂單編號：</span> <?=$b_id ?>
                <span class="hl_order_tb">下訂時間：</span> <?=$row['time'] ?>
                <span class="hl_order_tb">訂單總金額：</span> <span class="total_price"><?=$row['sum'] ?></span>
                <span class="hl_order_tb">是否付款：</span> <?=$pay ?></p>
              <table class="table table-hover table-condensed table-bordered table-striped order_list">
                <thead>
                  <tr>
                    <th><h3><strong> 項目 </strong></h3></th>
                    <th><h3><strong> 商品編號 </strong></h3></th>
                    <th><h3><strong> 商品名稱 </strong></h3></th>
                    <th><h3><strong> 原價 </strong></h3></th>
                    <th><h3><strong> 數量 </strong></h3></th>
                    <th><h3><strong> 小計 </strong></h3></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                // 把是該單號的每個商品顯示出
                for ($i = 1; $b_id == $row[0]; ++$i){
                  ?>
                  <tr>
                    <td> <?=$i ?> </td>
                    <td> <?=$row['product_id'] ?> </td>
                    <td> <?=$row['name'] ?> </td>
                    <td> <?=$row['price'] ?> </td>
                    <td> <?=$row['quantity'] ?> </td>
                    <td> <?=$row['quantity'] * $row['price'] ?> </td>
                  </tr>
                  <?php
                  // 顯示完後再取下一筆，這樣才可讓for loop判斷是否單號符合
                  $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                }
                ?>
                </tbody>
                <?php
                if ($pay == "否"){
                  ?>
                  <tfoot>
                    <tr>
                      <td colspan="6">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#credit<?=$b_id ?>" data-original-title>
                          <i class="fa fa-credit-card fa-fw"></i> 點我付款
                        </button>
                      </td>
                    </tr>
                  </tfoot>
                  <?php
                }
                ?>
              </table>
            </div>
            <!-- each order_list col div -->
          </div>
          <!-- each order_list Row -->
                <?php
                if ($row) {
                  echo "<hr />";
                }
              }
            }
            else {
              die(mysqli_error($link));
            }
             ?>

        </div>
        <!-- total order_list col div -->
      </div>
      <!-- total order_list Row -->
    </div>
    <!-- shopping list Container -->

 </div>
 <!-- /#wrapper -->
 <?php
 for ($i = 0; $i <= count($arr_bId); ++$i){
   ?>
   <div class="modal fade" id="credit<?=$arr_bId[$i] ?>" tabindex="-1" role="dialog" aria-labelledby="creditLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="demo">
             <div class="numbers">
                 <p>試試這些號碼：</p>

                 <ul class="list">
                     <li>4000 0000 0000 0002</li>
                     <li>4026 0000 0000 0002</li>
                     <li>5018 0000 0009</li>
                     <li>5100 0000 0000 0008</li>
                     <li>6011 0000 0000 0004</li>
                 </ul>
             </div>

             <form method="get" role="form">
                 <h4 style="font-weight:bold;">付款資訊</h4>

                 <ul>
                     <li>
                         <label for="card_number">信用卡號碼 (<a id="sample-numbers-trigger" href="#">點我試試</a>)</label>
                         <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" required autofocus>

                         <small class="help">支援信用卡種類：Visa, Visa Electron, Maestro, MasterCard, Discover</small>
                     </li>
                     <li>
                         <label for="expiry_date">信用卡到期日</label>
                         <input type="text" name="expiry_date" id="expiry_date" maxlength="5" placeholder="mm/yy" required autofocus>
                     </li>
                     <li>
                         <label for="cvv">CVV（信用卡檢查碼）</label>
                         <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="123" required autofocus>
                     </li>
                     <label for="name_on_card">信用卡持用者姓名</label>
                     <input type="text" name="name_on_card" id="name_on_card" placeholder="元Jack" required autofocus>
                 </ul>
                 <button type="submit" style="float: left;" class="btn btn-primary" onclick="payForOrder(<?=$arr_bId[$i] ?>);"> 送出 </button>
                 <button type="reset" style="float: left;" class="btn btn-info"> 重設 </button>

                 <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal"> 關閉 </button>
             </form>
         </div>
         <!-- demo div -->
     </div>
     <!-- modal dialog -->
   </div>
   <!-- modal fade -->
   <?php
 }
 ?>
 <?php include 'footer.php'; ?>
</body>

</html>
