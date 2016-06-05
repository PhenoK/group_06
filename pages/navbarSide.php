<!-- navbarSide -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
              <button class="btn btn-default btn-md" data-toggle="modal" data-target="#search" data-original-title>
                <i class="fa fa-search"></i> 搜尋商品
              </button>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> 圖書 <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-language fa-fw"></i> 中文書 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="product.php?p_type=book&lang=tw&b_type=program"><i class="fa fa-bug fa-fw"></i> 程式設計</a>
                            </li>
                            <li>
                                <a href="product.php?p_type=book&lang=tw&b_type=psycho"><i class="fa fa-heartbeat fa-fw"></i> 心理學總論</a>
                            </li>
                            <li>
                                <a href="product.php?p_type=book&lang=tw&b_type=health"><i class="fa fa-medkit fa-fw"></i> 保健常識</a>
                            </li>
                            <li>
                                <a href="product.php?p_type=book&lang=tw&b_type=philo"><i class="fa fa-question fa-fw"></i> 哲學總論</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="product.php?p_type=book&lang=en"><i class="fa fa-language fa-fw"></i> 英文書</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="product.php?p_type=3c"><i class="fa fa-desktop fa-fw"></i> 電腦電子周邊</a>
            </li>
            <li>
                <a href="product.php?p_type=game"><i class="fa fa-gamepad fa-fw"></i> 電玩遊戲</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="searchLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="panel panel-info">
      <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <br />
        <h4 class="panel-title" id="searchLabel"><i class="fa fa-search"></i> 搜尋商品（選填）</h4>
      </div>
      <form action="product.php" id="search_form" method="get" accept-charset="utf-8" role="form">
        <div class="modal-body" style="padding: 5px;">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8" style="padding-bottom: 10px;">
              <input class="form-control" id="item_name" name="item_name" placeholder="請輸入商品名稱" type="text" maxlength="20" />
            </div>
          </div>
          <ul class="list-group">
            <div class="radio">
              <label><input type="radio" name="p_type" value="book" required autofocus/>書本</label>
              <label><input type="radio" name="p_type" value="3c" required autofocus/>電腦電子周邊</label>
              <label><input type="radio" name="p_type" value="game" required autofocus/>電玩遊戲</label>
            </div>
          </ul>
          <br />
          <fieldset>
            <label for="price_min" style="font-weight:bold;">請選擇價格區間</label>
            <ul class="list-group">
              從
              <input type="number" id="price_min" class="form-control" name="price_min" min="0" step="10" max="200000" value="" />
              到
              <input type="number" id="price_max" class="form-control" name="price_max" min="0" step="10" max="200000" value="" />
            </ul>
          </fieldset>
        </div>
        <div class="panel-footer" style="margin-bottom:-14px;">
          <input type="submit" class="btn btn-success" value="送出" />
          <input type="reset" class="btn btn-danger" value="重設" />
          <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal"> 關閉 </button>
        </div>
      </form>
    </div>
    <!-- panel-info -->
  </div>
  <!-- modal-dialog -->
</div>
<!-- modal fade -->
