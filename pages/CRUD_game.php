
<!DOCTYPE html>
<html lang="en">
<head>
  <title>歡迎來到元經樵屋頂拍賣</title>
  <?php include 'head.php'; ?>
  <?php include 'initial.php'; ?>
 <?php if($_SESSION['level']!=2) header("location:signIn.php");?>
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
                              def: "game"
                          },{
                              "label": "商品名稱:",
                              "name": "name"
                          }, {
                              "label": "價格:",
                              "name": "price"
                          }, {
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
                      "ajax": "CRUD_getDataGame.php",
                      "table": "#game",
                      "fields": [
                         
                          {
                              "label": "編號:",
                              "name": "id"  
                          },{
                              "label": "遊戲類型:",
                              "name": "category",
                              type: "select",
                              options: [ "奇幻冒險","運動", "解謎"]
                              
                          }, {
                              "label": "遊戲語言",
                              "name": "lang",
                              type: "select",
                              options: [ "中文繁體", "英文" ],
                              def: "中文繁體"
                          }, {
                              "label": "上市日期:",
                              "name": "sale_date",
                               type:"datetime"
                          }, {
                              "label": "上市公司:",
                              "name": "company"
                          },{
                              "label": "遊戲平台:",
                              "name": "platform"
                          }, {
                              "label": "多人連線:",
                              "name": "multi_player",
                               type:  "radio",
				               options: [
				                    { label: "是", value: 0 },
				                    { label: "否",  value: 1 }
				               ],
				               "default":1
                          }
                     
                      ]
                  } );
                      $('#game').on( 'click', 'tbody td:not(:first-child)', function (e) {
                        editor.inline( this );
                    } );
                  var oTable = $('#game').DataTable( {
                       dom: "Bfrtip",
                      "ajax": {
                          url: "CRUD_getDataGame.php",
                          type: "POST"
                      },
                      "serverSide": true,
                      select: true,
                      columns: [
                          { data: "id" },
                          { data: "category" },
                          { data: "lang"},
                          { data: "sale_date" },
                          { data: "company" },
                          { data: "platform" },
                          { data: "multi_player"}
                         
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
                            <table id="game" name="display_product" class="table table-responsive table-bordered col-md-2  col-md-offset-1" style="margin: auto;">
                                   <thead>
                                     <tr>
                                       <th>遊戲編號</th>
                                       <th>遊戲類型</th>
                                       <th>遊戲語言</th>
                                       <th>上市日期</th>
                                       <th>上市公司</th>
                                       <th>遊戲平台</th>
                                       <th>多人連線</th>
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