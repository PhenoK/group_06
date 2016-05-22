<!-- 此為載入網頁前，有些資料項目就須動態取值，但有鑑於從MySQL取資料的流程無法提前，
故盡量將某些共同、可提前的變數提前賦值宣告 -->
<?php
  // 加入、移除購物車用
  $arr_cart = array_filter(explode(",", @$_COOKIE['cart']));
  const ADD = 1;
  const REMOVE = 2;
?>
