<!DOCTYPE html>
<html lang="en">
<head>
  <title>歡迎來到元經樵屋頂拍賣</title>
  <?php include 'head.php'; ?>
  <?php include 'initial.php'; ?>
 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.0/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="datatable/css/editor.dataTables.min.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  <script type="text/javascript" src="datatable/js/dataTables.editor.min.js"></script>
  
  
  <script  language="javascript">
  var sendRequest=function(){
  $.ajax({
  url: "CRUD_comfirm.php",
  data: $('#type').serialize(),
  type:"POST",
  dataType:'', 

  success: function(msg){ 
    $("#show").html(msg.substr(1));
    //document.getElementById('show_msg').innerHTML= msg.substr(1) ; 
  },

  error:function(xhr, ajaxOptions, thrownError){ 
    alert(xhr.status); 
    alert(thrownError); 
  }
});
}
  </script>

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
                                           <th>商品種類</th>
                                           <th><select name="type" id="type" onchange="sendRequest()">
                                               <option value="0"></option>
                                               <option value="1">書本</option>
                                               <option value="2">3c周邊資訊</option>
                                               <option value="3">電玩遊戲</option>
                                           </select>
                                           </th>
                                         </tr>
                                       </thead>
                                </table>
                            </form>
                    </div>
                </div>
               </div>
            </div>
            <div id="show">
                
            </div>
            
        <!-- row -->   
        </div> 
    <!-- container -->
</div>
<!-- /#wrapper -->
 <?php include 'footer.php'; ?>

</body>

</html>