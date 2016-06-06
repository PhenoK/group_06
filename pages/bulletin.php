<?php include_once('initial.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../images/favicon.ico"/>
  <link rel="bookmark" href="../images/favicon.ico"/>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Timeline CSS -->
  <link href="../css/timeline.css" rel="stylesheet">
  <!-- Custom SB-Admin2 CSS -->
  <link href="../css/sb-admin-2.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- group_06 css -->
  <link href="../css/group_06.css" rel="stylesheet">
  <!-- Custom scrolling-nav CSS -->
  <link href="../css/scrolling-nav.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!--jQuery-->
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
  <title>系統公告與關於我們</title>
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
  <div id="wrapper">
    <?php include 'navbarTop.php'; ?>
  </div>
  <!-- announce Section -->
  <section id="announce" class="announce-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>公告</h1>
          <table class="table table-hover table-condensed table-bordered table-striped">
            <thead>
              <tr>
                <th><h3><strong>版本號</h3></th>
                <th><h3><strong>版本日期</strong></h3></th>
                <th><h3><strong>說明</strong></h3></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.0</td>
                <td>2016/03/29</td>
                <td>Bootstrap樣板套用與修改，網站整體雛形建立（純靜態）</td>
              </tr>
              <tr>
                <td>2.0</td>
                <td>2016/06/06</td>
                <td>加入後端功能、資料庫資料</td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th><h3><strong>已完成功能</strong></h3></th>
                <th><h3><strong>未完成功能（能看見但使用無反應的）</strong></h3></th>
                <th><h3><strong>殘念未有功能</strong></h3></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <ol>
                    <li>尋覽列：各頁面索引均有功能。</li>
                    <li>商品菜單列：各商品頁面及其索引（可搜尋商品）。</li>
                    <li>商品頁面資訊（頁面下還可會員評論、會員評分；）。</li>
                    <li>可瀏覽商品、搜尋商品、將商品加入購物車後下訂（還可付款）。</li>
                    <li>留言板會員們可詢問問題、討論聊天</li>
                    <li>網站控制台中，管理員可新增、修改、刪除、查詢所有資料表資訊。</li>
                    <li>有稍微防SQL injection、XSS。</li>
                  </ol>
                </td>
                <td>
                  <ol>
                    <li>無</li>
                  </ol>
                </td>
                <td>
                  <ol>
                    <li><strong>不能真的付款給站方XD。</strong></li>
                    <li>HTML 5畫布功能。</li>
                    <li>當前、累積瀏覽人次。</li>
                  </ol>
                </td>
              </tr>
            </tbody>
          </table>
          <a class="btn btn-info page-scroll" href="#about">滑至關於</a>
          <a class="btn btn-success page-scroll" href="#contact">滑至聯絡資訊</a>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>關於</h1>
          <p>這是一個充滿元味的網站！</p>
          <p>由江雨樵、廖元豪、張勛凱三人協力製作，前端主要使用網路上免費開源的Bootstrap Template。</p>
          <p>書本資訊主要用程式爬蟲，格式有怪怪的地方煩請見諒Orz，一切網頁資料僅供學習用！不做任何營利用途。</p>
          <a class="btn btn-danger page-scroll" href="#announce">滑至公告</a>
          <a class="btn btn-success page-scroll" href="#contact">滑至聯絡資訊</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1>聯絡資訊</h1>
          <p>客服專線：0912345678</p>
          <p>客服時間：週二18:30~21:00（例假日除外）</p>
          <p>地址：彰化師範大學寶山校區工學院EB211 </p>
          <p>歡迎到留言版回報問題與交流唷！ </p>
          <a class="btn btn-danger page-scroll" href="#announce">滑至公告</a>
          <a class="btn btn-info page-scroll" href="#about">滑至關於</a>
        </div>
      </div>
    </div>
  </section>
  <!--jQuery-->
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <!-- Scrolling Nav JavaScript -->
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/scrolling-nav.js"></script>

</body>

</html>
