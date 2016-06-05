<!DOCTYPE html>
<html lang="en">
<head>
  <title>歡迎來到元經樵屋頂拍賣</title>
  <?php include 'head.php'; ?>
  <?php include 'initial.php'; ?>
  <?php
        if($_SESSION['level']!=2)
            header('Location:index.php');
  ?>
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
                      "ajax": "getMemberData.php",
                      "table": "#member",
                      "fields": [
                         
                          {
                              "label": "會員編號:",
                              "name": "id"  
                          },{
                              "label": "會員帳號:",
                              "name": "account"
                             
                          }, {
                              "label": "密碼:",
                              "name": "password"
                              
                          }, {
                              "label": "姓名:",
                              "name": "name"  
                          }, {
                              "label": "性別:",
                              "name": "sex"
                          }, {
                              "label": "生日:",
                              "name": "birth"
                          }, {
                              "label": "電話號碼:",
                              "name": "tel_no"
                          }, {
                              "label": "地址:",
                              "name": "addr"
                          }, {
                              "label": "電子郵件:",
                              "name": "mail"
                          }, {
                              "label": "暱稱:",
                              "name": "nickname"
                          }
                     
                      ]
                  } );
                 
                  var oTable = $('#member').DataTable( {
                       dom: "Bfrtip",
                      "ajax": {
                          url: "getMemberData.php",
                          type: "POST"
                      },
                      "serverSide": true,
                      select: true,
                      columns: [
                          { data: "id" },
                          { data: "account" },
                          { data: "password"},
                          { data: "name" },
                          { data: "sex" },
                          { data: "birth" },
                          { data: "tel_no" },
                          { data: "addr" },
                          { data: "mail" },
                          { data: "nickname" },
                          { data: "level" }
                      ],
                      buttons: 
                              [
                                 { extend: "remove",   editor: editor, text: '刪除' },
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
                   會員資料
                </div>
                <div class="panel-body panel-height"> 
                        <form class="form-horizontal" role="form" name="form" id="sentToBack"  method="POST" action="">
                            <table id="member" name="member" class="table table-responsive table-bordered col-md-2  col-md-offset-1" style="margin: auto;">
                                   <thead>
                                     <tr>
                                       <th>會員編號</th>
                                       <th>會員帳號</th>
                                       <th>密碼</th>
                                       <th>姓名</th>
                                       <th>性別</th>
                                       <th>生日</th>
                                       <th>電話號碼</th>
                                       <th>地址</th>
                                       <th>電子郵件</th>
                                       <th>暱稱</th>
                                       <th>會員等級</th>   
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