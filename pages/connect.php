<?php

$sn = "localhost";
$db = "group_06";
$un = "root";
$pw = "123456";

$link = mysqli_connect($sn, $un, $pw, $db) or die("資料庫連結有誤！<br>");
// encoding
mysqli_query($link, "SET CHARACTER SET utf8");
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

function mysql_entities_fix_string($link, $string){
  return htmlentities(mysql_fix_string($link, $string));
}
function mysql_fix_string($link, $string){
   if (get_magic_quotes_gpc())
       $string = stripcslashes($string);
   return mysqli_real_escape_string($link, $string);
}
?>
