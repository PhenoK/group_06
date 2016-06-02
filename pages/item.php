<?php
include_once 'initial.php';

// 若url沒有傳入商品id，將導向至首頁
if (!isset($_GET['id'])){
  header('Location: index.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once 'connect.php';
// 先從product table該id的資料中找出是哪一type(因為GET沒有傳type)
$id = @$_GET['id'];
$sql = "SELECT * FROM product WHERE id=$id";

if ($result = mysqli_query($link, $sql)){
  $row = mysqli_fetch_assoc($result);
  $tb = $row['type'];
  // free memory
  mysqli_free_result($result);
}
// 利用product id與type id兩資料表結合成一資料表
$sql = "SELECT * FROM product JOIN $tb ON product.id = $tb.id WHERE product.id=$id";
if ($result = mysqli_query($link, $sql)){
  $row = mysqli_fetch_assoc($result);
}

?>
<head>
  <!-- title:商品名稱 -->
  <title><?=$row['name'] ?></title>
  <?php include 'head.php'; ?>
</head>

<body>
  <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    <?php include 'navbarSide.php'; ?>

    <div id="page-wrapper">
      <!-- Page Header -->
      <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
          <blockquote>
            <h3 class="page-header"><?=$row['name'] ?></h1>
          </blockquote>
        </div>
      </div>
      <!-- /.row -->

      <!-- Product Info Row -->
      <div class="row">
        <!-- div img -->
        <div class="col-sm-2 col-lg-2 col-md-2">
          <a href="#_">
            <img src="<?=$row['pre_img'] ?>" alt="" class="img-thumbnail">
          </a>
        </div>
        <!-- div content -->
        <div class="col-sm-4 col-lg-4 col-md-4">
          <div class="caption">
            <!-- 商品資訊 -->
            <ul>
              <?php
                switch ($row['type']) {
                  case 'book':
                  ?>
                    <li>
                      <span>作者：</span>
                      <span><?=$row['author'] ?></span>
                    </li>
                    <li>
                      <span>譯者：</span>
                      <span><?=$row['translator'] ?></span>
                    </li>
                    <li>
                      <span>出版社：</span>
                      <span><?=$row['publisher'] ?></span>
                    </li>
                    <li>
                      <span>出版日：</span>
                      <span><?=$row['publish_date'] ?></span>
                    </li>
                    <li>
                      <span>ISBN：</span>
                      <span><?=$row['isbn'] ?></span>
                    </li>
                    <li>
                      <span>語言：</span>
                      <span><?=$row['lang'] ?></span>
                    </li>
                  <?php
                    break;

                  default:
                    break;
                }
               ?>
               <li>
                 <span>特價：</span>
                 <span>
                   <b class="dis">79</b>折
                   <i class="fa fa-usd fa-fw"></i><b class="dis"><?=$row['price'] ?></b>
                 </span>
               </li>
            </ul>

          </div>
          <br />
          <div class="ratings">
            <p class="pull-right"><?=$row['rank'] ?> 則評論</p>
            <p>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star-half-o"></span>
            </p>
            <?php include "cartAddRemove.php"; ?>
            <button id="p<?=$id ?>" class="btn btn-danger centered" onclick="cart(<?=$cart_func_oper ?>, <?=$id ?>, <?=$row['price'] ?>)"><i class="fa fa-cart-plus fa-fw"></i> <?=$cart_btn_oper ?>購物車<i class="fa"></i></button>
          </div>
        </div>
        <!-- div item img -->
        <div class="col-sm-6 col-lg-6 col-md-6">
          放畫廊
        </div>
      </div>
      <hr />
      <!-- Product Row -->

      <pre><?=mb_substr($row['content'], 0, strlen($row['content']))?></pre>
      <div class="well">
        <div class="text-right">
          <a class="btn btn-success">留言</a>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-12">
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-o"></span> 匿名
            <span class="pull-right">10 天前</span>
            <p>場景好漂亮喔</p>
          </div>
        </div>

        <hr>

      </div>


      </div>

    </div>
    <!-- /#wrapper -->
    <?php include 'footer.php'; ?>
</body>

</html>
