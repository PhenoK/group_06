<?php
include_once('connect.php');

//
$term = trim(strip_tags($_GET['term']));
$sql = "SELECT name FROM product WHERE name LIKE '%$term%'";

if ($result = mysqli_query($link, $sql)){
  while ($row = mysqli_fetch_assoc($result)){
    $name[] = $row['name'];
  }
  mysqli_free_result($result);
}

mysqli_close($link);
echo json_encode($name);
 ?>
