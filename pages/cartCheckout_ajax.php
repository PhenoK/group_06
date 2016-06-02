<?php
include_once('connect.php');
// 若瀏覽此網頁有$_POST的資料 => 要新增訂單
if (isset($_POST['arr_tPrice'])){
  // 購物車品項的商品id
  $arr_pId = $_POST['arr_pId'];
  // 單向商品的購買總金額
  $arr_tPrice = $_POST['arr_tPrice'];
  // 購買數量
  $arr_quan = $_POST['arr_quan'];
  // 帳號
  $account = $_POST['account'];

  // 購買時間
  $time = date("Y-m-d H:i:s");
  // 購買總金額
  $sum = array_sum($arr_tPrice);

  // 先建立訂單資料
  $sql = "INSERT INTO order_list (account, time, sum) VALUES ('$account', '$time', '$sum')";
  mysqli_query($link, $sql);

  // 再建立訂單中的詳細商品: order_product
  $b_id = mysqli_insert_id($link);
  for ($i = 0; $i < count($arr_pId); ++$i){
    $sql = "INSERT INTO order_product (b_id, product_id, quantity) VALUES ('$b_id', '$arr_pId[$i]', '$arr_quan[$i]')";
    mysqli_query($link, $sql);
  }
  echo "shit";
}

 ?>
