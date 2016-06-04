<?php
include_once 'initial.php';
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
    $icon_type = "book";
    $lab_type = "圖書";
    break;
}
if (!isset($_GET['p_type'])){
  $get_p_type = 'book';
}
else {
  $get_p_type = $_GET['p_type'];
}


switch (@$_GET['lang']) {
  case 'tw':
    $lang_type = "中文繁體";
    break;
  case 'en':
    $lang_type = "英文";
    break;
  default:
    $lang_type = "中文繁體";
    break;
}
if (!isset($_GET['lang'])){
  $get_lang_type = 'tw';
}
else {
  $get_lang_type = $_GET['lang'];
}

switch (@$_GET['b_type']) {
  case 'program':
    $b_type = "程式設計";
    break;
  case 'psycho':
    $b_type = "心理學總論";
    break;
  case 'health':
    $b_type = "保健常識";
    break;
  case 'philo':
    $b_type = "哲學總論";
    break;
  default:
    $b_type = "程式設計";
    break;
}
if (!isset($_GET['b_type'])){
  $get_b_type = 'program';
}
else {
  $get_b_type = $_GET['b_type'];
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
        $tb = $get_p_type;

        // 不管怎樣都要檢查item_name的存在，畢竟有平常非使用搜尋功能的可能
        if (isset($_GET['item_name'])){
          $item_name = $_GET['item_name'];
        }
        else {
          $item_name = "";
        }

        // 檢查price_min, max
        if (isset($_GET['price_min'])){
          $price_min = intval($_GET['price_min']);
          $price_max = intval($_GET['price_max']);
        }
        else {
          $price_min = 0;
          $price_max = 99999;
        }


        // 若有接受到任何搜尋商品的資訊
        if (isset($_GET['price_min'])){
          $sql = "SELECT * FROM product JOIN $tb ON product.id = $tb.id
          WHERE (name LIKE '%$item_name%')
          AND (price BETWEEN $price_min AND $price_max)";
        }
        else {
          if ($tb != 'book'){
            $sql = "SELECT * FROM product JOIN $tb ON product.id = $tb.id
            WHERE (name LIKE '%$item_name%)'
            AND (price BETWEEN $price_min AND $price_max)";
          }
          else {
            $sql = "SELECT * FROM product JOIN $tb ON product.id = $tb.id
            WHERE $tb.lang = '$lang_type'
            AND $tb.category = '$b_type'
            AND (name LIKE '%$item_name%)'
            AND (price BETWEEN $price_min AND $price_max)";
          }
        }

        if ($result = mysqli_query($link, $sql)){
          // 取出資料數
          $tb_rec = mysqli_num_rows($result);
          // 若沒資料就不用顯示了
          if ($tb_rec == 0){
            die("尚無商品資料或查詢結果唷！");
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
            if ($row == null){
              break;
            }
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
        else {
          $str_error = mysqli_error($link);
          die($str_error);
        }
       ?>
      </div>
      <!-- /. Product Row -->

      <!-- Pagination -->
      <div class="row text-center">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <ul class="pagination">
            <?php
            if ($icon_type == 'book'){
              $get_book_href = "&lang=$get_lang_type&b_type=$get_b_type";
            }
            else {
              $get_book_href = "";
            }
            $get_price_href = "&price_min=$price_min&price_max=$price_max";

            // 回到第一頁、上一頁的超連結
            if ($cur_page > 1){
              $prev_page = $cur_page - 1;
              ?>
            <li>
              <a href=?p_type=<?=$tb ?><?=$get_book_href ?><?=$get_price_href ?>&item_name<?=$item_name ?>&page=1>
                <i class="fa fa-angle-double-left"></i>
              </a>
            </li>
            <li>
              <a href=?p_type=<?=$tb ?><?=$get_book_href ?><?=$get_price_href ?>&item_name<?=$item_name ?>&page=<?=$prev_page ?>>
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
                echo "<a href=?p_type=$tb" . "$get_book_href" . "$get_price_href&item_name=$item_name" . "&page=$i> $i </a>";
                echo "</li>";
            }
            // 下一頁、最後一頁
            if ($cur_page < $total_pages){
              $next_page = $cur_page + 1;
              ?>
              <li>
                <a href=?p_type=<?=$tb ?><?=$get_book_href ?><?=$get_price_href ?>&item_name<?=$item_name ?>&page=<?=$next_page ?>>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
              <li>
                <a href=?p_type=<?=$tb ?><?=$get_book_href ?><?=$get_price_href ?>&item_name<?=$item_name ?>&page=<?=$total_pages ?>>
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
