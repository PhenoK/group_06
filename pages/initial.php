<?php
session_start();
// 若已經登入
if (isset($_SESSION['user'])){
  $logged = TRUE;
}
else {
  $logged = FALSE;
}
// 此為載入網頁前，有些資料項目就須動態取值，但有鑑於從MySQL取資料的流程無法提前，
// 故盡量將某些共同、可提前的變數提前賦值宣告
?>
