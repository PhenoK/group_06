<?php
include_once 'initial.php';
include_once 'connect.php';
// if (!$logged){
//   header('Location: signIn.php');
// }

// 取出購物車
if (isset($_COOKIE['cart'])){
  $cart = $_COOKIE['cart'];
}
else {
  $cart = "";
}
// 將購物車Cookie轉成陣列，並移除空值
$arr_cart = array_filter(explode(",", $cart));

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
      // 下拉式選單商品購買數量
      for (var j = 1; j <= 30; ++j){
        $('.cnt_item').append($('<option></option>').html(j).val(j));
      }

      // 若商品數量改變，小計數量也得改變
      $('.cnt_item').change(function(){
        // 取得選取數量
        var num = this.options[this.selectedIndex].text;
        // 取得該select是第幾個select（哪個商品的select）
        var idx = $('select').index($(this));
        // 利用此index取得該商品價格
        var price = $('.item_price').eq(idx).text();
        // 更改小計金額
        $('.total_price').eq(idx).text(price * num);

      });
  });

  </script>
</head>

<body>
 <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    </nav>

    <!-- shopping cart Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            <label class="label label-success"><i class="fa fa-shopping-cart fa-fw"></i> 購物車</label>
          </h1>
        </div>
      </div>

      <!-- shopping cart Row -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <table id="cart" class="table table-hover table-condensed table-bordered table-striped">
            <thead>
              <tr>
                <th><h3><strong> 項目 </strong></h3></th>
                <th><h3><strong> 商品編號 </strong></h3></th>
                <th><h3><strong> 商品名稱 </strong></h3></th>
                <th><h3><strong> 存貨量 </strong></h3></th>
                <th><h3><strong> 原價 </strong></h3></th>
                <th><h3><strong> 數量 </strong></h3></th>
                <th><h3><strong> 小計 </strong></h3></th>
                <th><h3><strong> 操作 </strong></h3></th>
              </tr>
            </thead>
            <?php

            $sql = "SELECT * FROM product";
            if ($result = mysqli_query($link, $sql)){
              for ($i = 0; $i < count($arr_cart); ++$i){
                echo "<tbody>";
                echo "<tr>";

                // 根據商品id，seek offset :商品id - 1
                mysqli_data_seek($result, $arr_cart[$i] - 1);
                $row = mysqli_fetch_assoc($result);
                echo "<td>" . ($i + 1) . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['inventory'] . "</td>";
                echo "<td class=\"item_price\">" . $row['price'] . "</td>";
                // 購買數量
                echo "<td>";
                $tmp = $i + 1;
                echo "<select name=\"cnt_item[]\" class=\"selectpicker cnt_item\" data-width=\"fit\" data-style=\"btn-default\" data-live-search=\"true\"></select>";
                echo "</td>";
                // 小計
                echo "<td class=\"total_price\">" . $row['price'] * 1 . "</td>";
                echo "<td><button class=\"btn btn-warning\"> 刪除 </button></td>";

                echo "</tr>";
                echo "</tbody>";
              }
            }
             ?>
          </table>
        </div>
      </div>
      <!-- shopping cart Row -->
    </div>
    <!-- shopping Container -->

 </div>
 <!-- /#wrapper -->

 <?php include 'footer.php'; ?>
</body>

</html>
