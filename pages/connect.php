<?php

$sn = "localhost";
$db = "group_06";
$un = "root";
$pw = "";

$link = mysqli_connect($sn, $un, $pw, $db) or die("資料庫連結有誤！<br>");
// encoding
mysqli_query($link, "SET CHARACTER SET utf8");
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

?>
