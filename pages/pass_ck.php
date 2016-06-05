<?php

$pwd = mysql_real_escape_string($_REQUEST['pass']) ;

include('connect.php');

$sql = "SELECT * FROM member where password='$pwd' ";

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

// 送出查詢的SQL指令
if ( $result = mysqli_query($link, $sql) ) {
    if( $row = mysqli_fetch_assoc($result) ){
        echo "true";
    } 
    else
    {
        echo "false";
    }
mysqli_free_result($result); 
}

mysqli_close($link); 
?>