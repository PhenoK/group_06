<?php
include_once('connect.php');

if (isset($_POST['p_id'])){
  $id = $_POST['p_id'];
}
else {
  // 不管有無權限，一定要有藉由管理員可看見的刪除商品的按鈕按下，所傳送出的POST值
  header('Location: index.php');
}

if ($result = mysqli_query($link, "DELETE FROM product WHERE id = '$id'")){
  echo "刪除成功！";
}
else {
  echo "刪除失敗！";
}

 ?>
