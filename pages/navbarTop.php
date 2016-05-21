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
        <?php
        // 這裡未來改成session
        $i = 1;
        if ($i == 1)
        {
          ?>
          <li>
              <a href="#">
                  <i class="fa fa-shopping-cart fa-fw"></i> 購物車<i class="fa"></i>
              </a>
              <!-- /.dropdown-shopcart -->
          </li>
          <!-- /.dropdown -->
        <?php
        }
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
    </ul>
    <!-- /.navbar-top-links -->
