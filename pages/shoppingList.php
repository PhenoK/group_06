<?php
include_once 'initial.php';
include_once 'connect.php';
if (!$logged){
  header('Location: signIn.php');
}

// 消費者帳號
$account = $_GET['account'];


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>元經樵 - 購物車</title>
  <?php include 'head.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <script>
    $(document).ready(function() {
      // 只選th，會跨table算size...
      var order_span = $('th').size() / $('thead').size();
      $('.pay').attr('colspan', parseInt(order_span));
    });



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
                  AND order_list.b_id = order_product.b_id
                  AND order_product.product_id = product.id";
            if ($result = mysqli_query($link, $sql)){
              // 取出資料數
              $tb_rec = mysqli_num_rows($result);
              // 若沒資料就不用顯示了
              if ($tb_rec == 0){
                die("目前尚無訂單資料唷！");
              }

              // 先取出一筆
              $row = mysqli_fetch_assoc($result);
              // 顯示完一筆單號後，檢查fetch是否有取到資料，若沒有就是沒訂單了
              while ($row){
                // 取得單號
                $b_id = $row['b_id'];
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
                for ($i = 1; $b_id == $row['b_id']; ++$i){
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
                  $row = mysqli_fetch_assoc($result);
                }
                ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td class="pay"><button class="btn btn-primary"><i class="fa fa-credit-card fa-fw"></i> 點我付款</button></td>
                  </tr>
                </tfoot>
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

 <?php include 'footer.php'; ?>
</body>

</html>
