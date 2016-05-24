<?php
  // 購物車數量
  if (isset($_COOKIE['cart'])){
    $cart = $_COOKIE['cart'];
  }
  else {
    $cart = "";
  }
  // 購物車總金額
  if (isset($_COOKIE['cart_price'])){
    $cart_price = $_COOKIE['cart_price'];
  }
  else {
    $cart_price = 0;
  }

  $oper = $_GET['oper'];
  $id = $_GET['id'];
  $price = $_GET['price'];

  // 將購物車Cookie轉成陣列，並移除空值
  $arr_cart = array_filter(explode(",", $cart));

  const ADD = 1;
  const REMOVE = 2;

  // 加入購物車
  if ($oper == ADD){
    if (!in_array($id, $arr_cart)){
      // 若Cookie中沒有此id，加入購物車陣列
      $arr_cart[] = $id;
      $cart_price += $price;
    }
  }
  elseif ($oper == REMOVE) {
    // 取消購物車
    // 搜尋id在Cookie陣列中的位置，並移除該id
    unset($arr_cart[array_search($id, $arr_cart)]);
    // 重新排列購物車id順序
    $arr_cart = array_values($arr_cart);
    $cart_price -= $price;
  }

  // 將所有商品以逗號連結成一字串
  $cart = implode(",", $arr_cart);
  // 連結後的結果也就是當初Cookie中cart連結的形式，將此寫入Cookie，保留1個小時
  setcookie("cart", $cart, time() + 3600);
  // 更新購物車累積金額Cookie
  setcookie("cart_price", $cart_price, time() + 3600);

  // 將購物車累積金額放到所有購物車品項id的後面
  $arr_cart[] = $cart_price;
  //傳回JSON格式資料給原網頁
  echo json_encode($arr_cart);
?>
