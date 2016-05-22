<?php
  if (isset($_COOKIE['cart'])){
    $cart = $_COOKIE['cart'];
  }
  else {
    $cart = "";
  }
  $oper = $_GET['oper'];
  $id = $_GET['id'];

  // 將購物車Cookie轉成陣列，並移除空值
  $arr_cart = array_filter(explode(",", $cart));

  const ADD = 1;
  const REMOVE = 2;

  // 加入購物車
  if ($oper == ADD){
    if (!in_array($id, $arr_cart)){
      // 若Cookie中沒有此id，加入購物車陣列
      $arr_cart[] = $id;
    }
  }
  elseif ($oper == REMOVE) {
    // 取消購物車
    // 搜尋id在Cookie陣列中的位置，並移除該id
    unset($arr_cart[array_search($id, $arr_cart)]);
    // 重新排列購物車id順序
    $arr_cart = array_values($arr_cart);
  }

  // 將所有商品以逗號連結成一字串
  $cart = implode(",", $arr_cart);
  // 連結後的結果也就是當初Cookie中cart連結的形式，將此寫入Cookie，保留1個小時
  setcookie("cart", $cart, time() + 3600);

  //傳回JSON格式資料給原網頁
  echo json_encode($arr_cart);
?>
