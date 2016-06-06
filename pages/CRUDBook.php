
<!DOCTYPE html>
<html lang="en">
<head>
  <title>歡迎來到元經樵屋頂拍賣</title>
  <?php include 'head.php'; ?>
  <?php include 'initial.php'; ?>
 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.0/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="../datatable/css/editor.dataTables.min.css">
  <script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  <script type="text/javascript" src="../datatable/js/dataTables.editor.min.js"></script>
 <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.0/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.0/js/buttons.print.min.js"></script> 
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script> 
  
  
  <script  language="javascript">
      

      $(document).ready(function(){

                      editor = new $.fn.dataTable.Editor( {
                      "ajax": "CRUD_getData.php",
                      "table": "#product",
                      "fields": [ 
                          {
                              "label": "商品類型:",
                              "name": "type",
                              type: "select",
                              options: [ "book", "3c" ,"game"],
                              def: "book"
                          },{
                              "label": "商品名稱:",
                              "name": "name"
                          }, {
                              "label": "價格:",
                              "name": "price"
                          },{
                              "label": "商品簡介:",
                              "name": "content"
                          },{
                              "label": "商品存貨量:",
                              "name": "inventory"
                          }, {
                              "label": "商品評價:",
                              "name": "rank"
                          }, {
                              "label": "銷售量:",
                              "name": "sales"
                          }, {
                              "label": "商品預覽圖片:",
                              "name": "pre_img"
                          }, {
                              "label": "商品介紹圖片1:",
                              "name": "intro_img1"
                          }, {
                              "label": "商品介紹圖片2:",
                              "name": "intro_img2"
                          }, {
                              "label": "商品介紹圖片3:",
                              "name": "intro_img3"  
                           },{
                              "label": "商品介紹影片:",
                              "name": "intro_video"
                           }       
                      ]
                  } );
                    
                   
                  var oTable = $('#product').DataTable( {
                       
                      scrollX: true,
                       dom: "Bfrtip",
                      "ajax": {
                          url: "CRUD_getData.php",
                          type: "POST"
                      },
                      scrollX:true,
                      "serverSide": true,
                      select: true,
                      columns: [
                          { data: "id" },
                          { data: "type" },
                          { data: "name"},
                          { data: "price" },
                          { data: "inventory" },
                          { data: "rank" },
                          { data: "sales"},
                          { data: "pre_img" },
                          { data: "intro_img1" },
                          { data: "intro_img2" },
                          { data: "intro_img3" },
                          { data: "intro_video" }
                      ],
                        buttons: 
                              [
                                  { extend: "create",   editor: editor, text: '新增' },
                                  { extend: "edit",   editor: editor, text: '修改' },
                                  { extend: "remove", editor: editor, text: '刪除' },
                                  {
                                  extend: 'collection',
                                  text: '匯出',
                                  buttons: [
                                      'copy',
                                      'excel',
                                      'csv',
                                      'pdf',
                                      'print'
                                  ]
                                  }
                              ],
                        "pagingType": "full_numbers"
                  } );

                   
       } );   

    $(document).ready(function(){  
                      editor = new $.fn.dataTable.Editor( { 
                      "ajax": "CRUD_getDataBook.php",
                      "table": "#book",
                      "fields": [
                         
                          {
                              "label": "編號:",
                              "name": "id"  
                          },{
                              "label": "書本語言:",
                              "name": "lang",
                              type: "select",
                              options: [ "中文繁體", "英文" ],
                              def: "中文繁體"
                          }, {
                              "label": "書本類型:",
                              "name": "category",
                              type: "select",
                              options: [ "程式設計","心理學總論", "保健常識","哲學總論","其他"]
                          }, {
                              "label": "作者:",
                              "name": "author"  
                          }, {
                              "label": "譯者:",
                              "name": "translator"
                          }, {
                              "label": "出版商:",
                              "name": "publisher",
                          }, {
                              "label": "出版日期:",
                              "name": "publish_date",
                              type: "datetime"
                          }, {
                              "label": "ISBN:",
                              "name": "isbn",
                          }
                     
                      ]
                  } );
                  $('#book').on( 'click', 'tbody td:not(:first-child)', function (e) {
                        editor.inline( this );
                    } ); 
                  var oTable = $('#book').DataTable( {
                       dom: "Bfrtip",
                      "ajax": {
                          url: "CRUD_getDataBook.php",
                          type: "POST"
                      },
                      "serverSide": true,
                      select: true,
                      columns: [
                          { data: "id" },
                          { data: "lang" },
                          { data: "category"},
                          { data: "author" },
                          { data: "translator" },
                          { data: "publisher" },
                          { data: "publish_date"},
                          { data: "isbn" }
                         
                      ],
                        buttons: 
                              [
                                  { extend: "create",   editor: editor, text: '新增' },
                                  { extend: "edit",   editor: editor, text: '修改' },
                                  {
                                  extend: 'collection',
                                  text: '匯出',
                                  buttons: [
                                      'copy',
                                      'excel',
                                      'csv',
                                      'pdf',
                                      'print'
                                  ]
                                  }
                              ],
                        "pagingType": "full_numbers"
                  } );
                   
  } );       
  
       
</script>
<style>

</style>
</head>

<body>

<div id="wrapper">
    <?php include 'navbarTop.php'; ?>
    </nav>
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center" >
                    商品新增
                </div>
                <div class="panel-body panel-height"> 
                        <form class="form-horizontal" role="form" name="form" id="sentToBack"  method="POST">
                          
                                <table id="product" name="display_product" class="table table-responsive table-bordered col-md-2  col-md-offset-1" style="margin: auto;">
                                   <thead>
                                     <tr>
                                        
                                       <th>商品編號</th>
                                       <th>商品類型</th>
                                       <th>商品名稱</th>
                                       <th>價格</th>
                                       <th>商品存貨量</th>
                                       <th>商品評價</th>
                                       <th>銷售量</th>
                                       <th>商品預覽圖片</th>
                                       <th>內部介紹圖片1</th>
                                       <th>內部介紹圖片2</th>
                                       <th>內部介紹圖片3</th>
                                       <th>內部介紹影片</th>
                                     </tr>
                                   </thead>
                            </table>
                        </form>
                </div>
            </div>
           </div>
        </div>
         <div class="row">
          <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center" >
                    商品新增
                </div>
                <div class="panel-body panel-height"> 
                        <form class="form-horizontal" role="form" name="form" id="sentToBack"  method="POST">
                            <table id="book" name="display_product" class="table table-responsive table-bordered col-md-2  col-md-offset-1" style="margin: auto;">
                                   <thead>
                                     <tr>
                                       <th>書本編號</th>
                                       <th>書本語言</th>
                                       <th>書本類型</th>
                                       <th>作者</th>
                                       <th>譯者</th>
                                       <th>出版商</th>
                                       <th>出版日</th>
                                       <th>ISBN</th>
                                     </tr>
                                   </thead>
                            </table>
                        </form>
                </div>
            </div>
           </div>
        </div>
    <!-- row -->   
    </div> 
    <!-- container -->
</div>
<!-- /#wrapper -->
 <?php include 'footer.php'; ?>

</body>

</html>