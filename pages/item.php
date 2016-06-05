<?php
include_once 'initial.php';

// 若url沒有傳入商品id，將導向至首頁
if (!isset($_GET['id'])){
    header('Location: index.php');
}

if(@$_GET['page'])
    $page=$_GET['page'];
else
    $page=1;

?>
<!DOCTYPE html>
<html lang="en">
<?php
    include_once 'connect.php';
    // 先從product table該id的資料中找出是哪一type(因為GET沒有傳type)
    $id = @$_GET['id'];
    $sql = "SELECT * FROM product WHERE id=$id";

    if ($result = mysqli_query($link, $sql)){
        // 若商品id不存在就導向回product.php
        if (mysqli_num_rows($result) == 0) {
          echo "<script>window.location = 'product.php'</script>";
        }
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

    $result_rank=mysqli_query($link,"SELECT * FROM product_review WHERE product_id='$id'");
    $review_num=mysqli_num_rows($result_rank);

?>

<head>
    <!-- title:商品名稱 -->
    <title>
        <?=$row['name'] ?>
    </title>
    <?php include 'head.php'; ?>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript"  src="additional-methods.min.js"></script>
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
                window.location = 'product.php';
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
        $(document).ready(function($) {

            jQuery.validator.addMethod("none", function(value, element) {
                return value.split(" ").length - 1 < value.length;
            }, "請勿輸入空白內容");

            $("#form_msg").validate({
                submitHandler: function(form) {

                    $(form).ajaxSubmit({
                        type: "POST",
                        url: "send_msg.php",
                        dataType: "text",
                        data: $('#form_msg').serialize(),

                    });

                },

                errorPlacement: function(error, element) {

                    if (element.is(':radio') || element.is(':checkbox')) {
                        var eid = element.attr('name');
                        $('input[name=' + eid + ']:last').next().after(error);
                    } else {
                        error.insertAfter(element);
                    }
                },



                rules: {

                    message: {

                        none: true,
                        required: true,

                    }

                },

                messages: {

                    message: {
                        required: "請輸入留言",
                    }

                }

            });

        });
        </script>

        <style>
        #section1 {
            height: 50px; // Set this height to the appropriate size
            overflow-y: scroll; // Only add scroll to vertical column
        }

        textarea {
            resize: none;
        }

        pre {
            margin-bottom: 5px;
        }
        </style>
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
          <img src="<?=$row['pre_img'] ?>" alt="" class="img-thumbnail">
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
            <p class="pull-right"><?=$review_num ?> 則評論</p>
            <p>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star-half-o"></span>
            </p>

          </div>

          <?php include "cartAddRemove.php"; ?>
          <button id="p<?=$id ?>" class="btn btn-danger centered" onclick="cart(<?=$cart_func_oper ?>, <?=$id ?>, <?=$row['price'] ?>)">
            <i class="fa fa-shopping-cart fa-fw"></i> <?=$cart_btn_oper ?>購物車<i class="fa"></i>
          </button>

          <?php
          // 若是管理員
          if ($_SESSION['level'] == 2){
            // 可下架商品
            ?>
            <button type="button" class="btn btn-inverse centered" onclick="delProduct(<?=$id ?>);">
              <i class="fa fa-trash fa-fw"></i> 刪除商品<i class="fa"></i>
            </button>
            <?php
          }
           ?>
        </div>
        <div class="col-sm-6 col-lg-6 col-md-6">
            <!-- amazingcarousel container -->
            <div id="amazingcarousel-container-1">
                <div id="amazingcarousel-1" style="display:block;position:relative;width:100%;max-width:720px;margin:0px auto 0px;">
                    <div class="amazingcarousel-list-container">
                        <ul class="amazingcarousel-list">
                          <?php
                            for ($img_idx = 1; $img_idx <= 3; ++$img_idx){
                              $img_offset = 'intro_img' . $img_idx;
                              $img_src = $row[$img_offset];
                              if ($img_src == null){
                                $img_src = "../images/noImg.png";
                              }
                              ?>
                              <li class="amazingcarousel-item">
                                  <div class="amazingcarousel-item-container">
                                      <div class="amazingcarousel-image">
                                          <a href="<?=$img_src ?>" class="html5lightbox" data-group="amazingcarousel-1"><img src=<?=$img_src ?> /></a>
                                      </div>
                                  </div>
                              </li>
                            <?php
                            }
                           ?>
                            <li class="amazingcarousel-item">
                                <div class="amazingcarousel-item-container">
                                    <div class="amazingcarousel-image">
                                        <a href="https://www.youtube.com/embed/pAyMDW2we1s" class="html5lightbox" data-group="amazingcarousel-1"><img src="../images/video.png" /></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="amazingcarousel-prev"></div>
                        <div class="amazingcarousel-next"></div>
                    </div>
                    <div class="amazingcarousel-nav"></div>
                    <div class="amazingcarousel-engine"><a href="http://amazingcarousel.com">JavaScript Carousel</a></div>
                </div>
            </div>
            <!-- End of amazingcarousel container -->
        </div>
        <!-- 畫廊 -->
      </div>

      <hr />
      <!-- Product Row -->

      <pre><?=mb_substr($row['content'], 0, strlen($row['content']))?></pre>

    <!-- Comment -->


      <div class="well">
        <form method="POST" role="form" name="form_msg" id="form_msg" action="send_msg.php?id=<?=$id?>">
          <div class="row">
              <div class="form-group">
                  <?php
                      if(isset($_SESSION['user'])){
                          echo "
                              <div class='col-md-10'>
                                  <textarea  name='message' id='message' rows='5' class='form-control'></textarea>
                              </div>";
                      }
                      else{
                          echo "
                              <div class='col-md-10 text-center'>
                                  <pre style='margin:14px;'>請先登入以進行留言</pre>
                              </div>";
                      }
                  ?>
              </div>

              <div class="col-md-2 text-right">
                  <?php
                      if(isset($_SESSION['user']))
                          echo"<button type='submit' class='btn btn-success' >留言</button>";
                      else
                          echo "<a class='btn btn-success' href='signIn.php'>登入</a>";
                  ?>
              </div>
          </div>
        </form>

        <hr>


        <div class="embed-responsive embed-responsive-16by9">
          <iframe src="msgarea.php?page=1&id=<?=$id?>">
          </iframe>
        </div>

      </div>
      <!-- well -->
    </div>
    <!-- page-wrapper -->
  </div>
  <!-- /#wrapper -->

    <?php include 'footer.php'; ?>
</body>

</html>
