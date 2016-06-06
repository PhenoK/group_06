<?php
include_once('initial.php');
include_once('connect.php');

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>歡迎來到元經樵屋頂拍賣</title>
  <?php include 'head.php'; ?>
  <script>
  function delProduct(id){
    if (!confirm("確定要刪除？")){
        return false;
    }
    $.ajax({
      url: 'delProduct_ajax.php',
      data: {
        p_id: id
      },
      type: 'POST',
      dataType: "text",
      success: function(text) {
        if (text.indexOf("成功")){
          alert(text);
          location.reload();
        }
        else {
          alert(text);
          return;
        }

      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert("刪除失敗！");
      }
    });
  }
  </script>
</head>

<body>
  <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    <?php include 'navbarSide.php'; ?>
    <div id="page-wrapper">
      <div class="row">
        <div class="col-md-12">
          <div class="row carousel-holder">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <a href="item.php?id=177"><img class="slide-image" src="../images/coolpc-creative-fatal1ty.gif" alt="coolpc-creative-fatal1ty"></a>
                </div>
                <div class="item">
                  <a href="item.php?id=176"><img class="slide-image" src="../images/plextorM6S_hDiscount.jpg" alt="plextorM6S_hDiscount"></a>
                </div>
                <div class="item">
                  <a href="item.php?id=165"><img class="slide-image" src="../images/howToFlyAHorse.jpg" alt="howToFlyAHorse"></a>
                </div>
              </div>
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>


        <?php
        $sql = "SELECT * FROM product ORDER BY sales DESC LIMIT 6";
        if ($result = mysqli_query($link, $sql)){
        for ($panel_i = 1; $panel_i <= 2; ++$panel_i){
          if ($panel_i == 1)
            $panel_type = "bolt";
          else
            $panel_type = "eye";
          // panel-title
          if ($panel_i == 1){
            $p_tp = "red";
            $p_tit = "熱門商品";
          }
          else {
            $p_tp = "green";
            $p_tit = "最新商品";
          }
          ?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
              <div class="panel panel-<?=$p_tp ?>">
                <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-<?=$panel_type ?> fa-fw"></i> <?=$p_tit ?></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                  <?php
                    for ($i = 1; $i <= 3; ++$i){
                      // if (!in_array($id, $arr_product)){
                      //   // 若顯示在首頁中的商品尚未此id，加入顯示的陣列
                      //   $arr_cart[] = $id;
                      //   $cart_price += $price;
                      // }
                      // $arr_product[] =
                      $row = mysqli_fetch_assoc($result);
                      $id = $row['id'];
                      ?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <a href="item.php?id=<?=$row['id'] ?>">
                            <img src="<?=$row['pre_img'] ?>" alt="" class="img-thumbnail">
                          </a>
                          <h4><a href="item.php?id=<?=$row['id'] ?>"><?=$row['name'] ?></a></h4>
                          <?php
                          include "cartAddRemove.php";
                          ?>
                          <button id="p<?=$id ?>" class="btn btn-danger centered" onclick="cart(<?=$cart_func_oper ?>, <?=$id ?>, <?=$row['price'] ?>)">
                            <i class="fa fa-cart-plus fa-fw"></i> <?=$cart_btn_oper ?>購物車<i class="fa"></i>
                          </button>
                          <?php
                          // 若是管理員
                          if (@$_SESSION['level'] == 2){
                            // 可下架商品
                            ?>
                            <button type="button" class="btn btn-inverse centered" onclick="delProduct(<?=$id ?>);">
                              <i class="fa fa-trash fa-fw"></i> 刪除商品<i class="fa"></i>
                            </button>
                            <?php
                          }
                           ?>
                          <h4 class="pull-right"> 特價<?=$row['price'] ?>元</h4>
                        </div>
                        <!-- div each product -->
                      <?php
                    }

                 ?>
                  </div>
                  <!-- 三個product的row -->
                </div>
                <!-- panel body -->
              </div>
              <!-- panel-->
            </div>
            <!-- col -->
          </div>
          <!-- popular product Row-->
          <?php
        }
        ?>
        </div>
        <!-- total product row -->
        <?php
      }
      else {
        echo "尚無商品資料唷！";
      }
         ?>

    </div>
    <!-- page-wrapper -->
  </div>
  <!-- /#wrapper -->

  <?php include 'footer.php'; ?>

</body>

</html>
