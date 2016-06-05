<?php
include_once('connect.php');

if (isset($_POST['id'])){
  $id = $_POST['id'];
}
else {
  // 不管有無權限，一定要有藉由管理員可看見的刪除商品的按鈕按下，所傳送出的POST值
  header('Location: index.php');
}

if ($result = mysqli_query($link, "UPDATE order_list SET pay = '1' WHERE id = '$id'")){
  echo "付款成功！";
}
else {
  echo "付款失敗！";
}

 ?>
