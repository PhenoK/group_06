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
                <th><h3> <strong> 項目 </strong></h3></th>
                <th><h3> <strong> 商品編號 </strong></h3></th>
                <th><h3> <strong> 商品名稱 </strong></h3></th>
                <th><h3> <strong> 原價 </strong></h3></th>
                <th><h3> <strong> 數量 </strong></h3></th>
                <th><h3> <strong> 金額 </strong></h3></th>
                <th> </th>
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
                echo "<td id=\"item_price\">" . $row['price'] . "</td>";
                echo "<td id=\"cnt_item\">  1   </td>";
                echo "<td id=\"total_price\">" . $row['price'] * 1 . "</td>";
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
