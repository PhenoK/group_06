<?php
include_once 'initial.php';

// 若url沒有傳入商品type，將導向至首頁
if (!isset($_GET['p_type'])){
  header('Location: index.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once 'connect.php';
// tb: table
switch (@$_GET['p_type']) {
  case 'book':
    $icon_type = "book";
    $lab_type = "圖書";
    break;
  case '3c':
    $icon_type = "desktop";
    $lab_type = "電腦電子周邊";
    break;
  case 'game':
    $icon_type = "gamepad";
    $lab_type = "電玩遊戲";
    break;
  default:
    break;
}
?>
<head>
  <title>元經樵 - <?=$lab_type ?></title>
  <?php include 'head.php'; ?>
</head>

<body>
  <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    <?php include 'navbarSide.php'; ?>
    <div id="page-wrapper">
      <!-- Page Header -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"><label class="label label-info"><i class="fa fa-<?=$icon_type ?> fa-fw"></i> <?=$lab_type ?></label></h1>
        </div>
      </div>
      <!-- /.row -->

      <!-- Product Row -->
      <div class="row">
      <?php
        // 利用product id與type id兩資料表結合成一資料表
        $tb = @$_GET['p_type'];
        $sql = "SELECT * FROM product JOIN $tb ON product.id = $tb.id";

        if ($result = mysqli_query($link, $sql)){
          // 取出資料數
          $tb_rec = mysqli_num_rows($result);
          // 若沒資料就不用顯示了
          if ($tb_rec == 0){
            die("目前尚無商品資料唷！");
          }
          // 每一頁有幾筆
          $per = 5;
          // 計算共需幾頁
          $total_pages = ceil($tb_rec / $per);

          // 取得或設定current_page
          if (@$_GET['page']){
            // 避免輸入url的是小數
            $cur_page = (int)$_GET['page'];

            // 避免輸入到存在的頁數的範圍外
            if ($cur_page <= 0){
              $cur_page = 1;
            }
            elseif ($cur_page > $total_pages){
              $cur_page = $total_pages;
            }
          }
          else {
            $cur_page = 1;
          }
          // 根據當前頁數計算要從資料表的第幾筆資料開始提取
          $offset = ($cur_page - 1) * $per;
          include "cartAddRemove.php";
          mysqli_data_seek($result, $offset);
          for ($i = 1; $i <= $per; ++$i){
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            ?>
            <div class="row">
              <!-- div img -->
              <div class="col-sm-2 col-lg-2 col-md-2">
                <a href="item.php?id=<?=$row['id'] ?>">
                  <img src="<?=$row['pre_img'] ?>" alt="" class="img-thumbnail">
                </a>
              </div>
              <!-- div item info -->
              <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="caption">
                  <h4><a href="item.php?id=<?=$row['id'] ?>"><?=$row['name'] ?></a></h4>
                  <p><?=mb_substr($row['content'], 0, 200)?></p>
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
                </div>
                <?php
                include "cartAddRemove.php";
                ?>
                <button id="p<?=$id ?>" class="btn btn-danger centered" onclick="cart(<?=$cart_func_oper ?>, <?=$id ?>, <?=$row['price'] ?>)"><i class="fa fa-cart-plus fa-fw"></i> <?=$cart_btn_oper ?>購物車<i class="fa"></i></button>
                <h4 class="pull-right">79折 特價<?=$row['price'] ?>元</h4>
              </div>
            </div>
            <hr>
            <?php
          }

          // free memory
          mysqli_free_result($result);
        }
       ?>
      </div>
      <!-- /. Product Row -->

      <!-- Pagination -->
      <div class="row text-center">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <ul class="pagination">
            <?php
            // 回到第一頁、上一頁的超連結
            if ($cur_page > 1){
              $prev_page = $cur_page - 1;
              ?>
            <li>
              <a href=?p_type=<?=$tb ?>&page=1>
                <i class="fa fa-angle-double-left"></i>
              </a>
            </li>
            <li>
              <a href=?p_type=<?=$tb ?>&page=<?=$prev_page ?>>
                <i class="fa fa-angle-left"></i>
              </a>
            </li>
              <?php
            }
            // 1 ~ X頁
            for ($i = 1; $i <= $total_pages; ++$i){
              // 若與當前頁數相同 => active
              if ($i == $cur_page){
                echo "<li class=\"active\">";
              }
              else {
                echo "<li>";
              }
                echo "<a href=?p_type=$tb&page=$i> $i </a>";
                echo "</li>";
            }
            // 下一頁、最後一頁
            if ($cur_page < $total_pages){
              $next_page = $cur_page + 1;
              ?>
              <li>
                <a href=?p_type=<?=$tb ?>&page=<?=$next_page ?>>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
              <li>
                <a href=?p_type=<?=$tb ?>&page=<?=$total_pages ?>>
                  <i class="fa fa-angle-double-right"></i>
                </a>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
      </div>
      <!-- pagin row -->
    </div>
    <!-- page-wrapper -->
  </div>
  <!-- /#wrapper -->

  <?php include 'footer.php'; ?>
</body>

</html>
