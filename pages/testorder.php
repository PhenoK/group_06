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
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  <script type="text/javascript" src="../datatable/js/dataTables.editor.min.js"></script>

  
  
  
  <script  language="javascript">

    $(document).ready(function(){  
                      editor = new $.fn.dataTable.Editor( { 
                      "ajax": "getOrderData.php",
                      "table": "#order",
                      "fields": [
                          {
                              "label": "編號:",
                              "name": "id"  
                          },{
                              "label": "書本語言:",
                              "name": "account"
                          }, {
                              "label": "書本類型:",
                              "name": "time"
                          }, {
                              "label": "作者:",
                              "name": "sum"  
                          }, {
                              "label": "譯者:",
                              "name": "pay"
                          }
                     
                      ]
                  } ); 
                  var oTable = $('#order').DataTable( {
                       dom: "Bfrtip",
                      "ajax": {
                          url: "getOrderData.php",
                          type: "POST"
                      },
                      "serverSide": true,
                      select: true,
                      columns: [
                          { data: "id"},
                          { data: "account"},
                          { data: "time"},
                          { data: "sum"},
                          { data: "pay"}
                      ],
                        buttons: 
                              [
                                  { extend: "create",   editor: editor, text: '新增' },
                                  { extend: "edit",   editor: editor, text: '修改' }
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
                            <table id="order" name="display_product" class="table table-responsive table-bordered col-md-2  col-md-offset-1" style="margin: auto;">
                                   <thead>
                                     <tr>
                                       <th>書本編號</th>
                                       <th>書本語言</th>
                                       <th>書本類型</th>
                                       <th>作者</th>
                                       <th>譯者</th>
                                       
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