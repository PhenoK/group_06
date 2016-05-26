<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">元經樵屋頂拍賣</a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li>
            <a href="bulletin.php">
                <i class="fa fa-info-circle fa-fw"></i> 系統公告與關於我們<i class="fa"></i>
            </a>
            <!-- /.dropdown-bulletin -->
        </li>
        <!-- /.dropdown -->
        <li>
            <a href="shoppingCart.php">
                <?php
                $arr_cart = array_filter(explode(",", @$_COOKIE['cart']));
                define("ADD", "1");
                define("REMOVE", "2");
                ?>
                <i class="fa fa-shopping-cart fa-fw"></i> 購物車 <span id="cart_cnt" class="badge alert-danger"><?=sizeof($arr_cart) ?></span>
                <span id="cart_price" class="badge alert-success"><i class="fa fa-usd fa-fw"></i><?=@$_COOKIE['cart_price'] ?></span><i class="fa"></i>
            </a>
            <!-- /.dropdown-shopcart -->
        </li>
        <!-- /.dropdown -->
        <?php
        // initial.php會檢查session，其中的$logged為登入狀態
        if (!$logged){
          ?>
          <li>
              <a href="signIn.php">
                  <i class="fa fa-sign-in fa-fw"></i> 登入<i class="fa"></i>
              </a>
              <!-- /.dropdown-plus -->
          </li>
          <!-- /.dropdown -->
          <li>
              <a href="signUp.php">
                  <i class="fa fa-plus-square fa-fw"></i> 加入會員<i class="fa"></i>
              </a>
              <!-- /.dropdown-plus -->
          </li>
          <?php
        }
        else {
          // 若為管理者
          if ($_SESSION['level'] == 2){
            ?>
            <li>
                <a href="controlPanel.php">
                    <i class="fa fa-sitemap fa-fw"></i> 網站控制台<i class="fa"></i>
                </a>
                <!-- /.dropdown-plus -->
            </li>
            <!-- /.dropdown -->
            <?php
          }
          ?>

          <li>
              <a href="profile.php">
                  <i class="fa fa-user fa-fw"></i> 個人帳戶<i class="fa"></i>
              </a>
              <!-- /.dropdown-plus -->
          </li>
          <!-- /.dropdown -->
          <li>
              <a href="signIn.php?action=logout">
                  <i class="fa fa-sign-out fa-fw"></i> 登出<i class="fa"></i>
              </a>
              <!-- /.dropdown-plus -->
          </li>
          <!-- /.dropdown -->
          <?php
        }
         ?>
    </ul>
    <!-- /.navbar-top-links -->
