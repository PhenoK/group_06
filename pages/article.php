<?php
  include_once('initial.php');
  include('connect.php');

  if(@$_GET['id'])
    $a_id=$_GET['id'];
  else
    echo " <script language='JavaScript'>history.go(-1);</script>";
  if(@$_GET['page'])
    $page=$_GET['page'];
  else
    $page=1;
  
  mysqli_query($link, "SET CHARACTER SET utf8");
  mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

  $sql="SELECT * FROM article WHERE id='$a_id'";
  $result=mysqli_query($link,$sql);
  $row=mysqli_fetch_assoc($result);
  $title=$row['title'];

 ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>
            <?=$title?>
        </title>
        <?php include 'head.php'; ?>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <script type="text/javascript"  src="additional-methods.min.js"></script>

        <script>
            $(document).ready(function($) {

                jQuery.validator.addMethod("none", function(value, element) {
                    return value.split(" ").length - 1 < value.length;
                }, "請勿輸入空白內容");

                $("#form_article").validate({
                    submitHandler: function(form) {

                        $(form).ajaxSubmit({
                            type: "POST",
                            url: "new_response.php",
                            dataType: "text",
                            data: $('#form_article').serialize(),

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

                        new_res: {

                            none: true,
                            required: true,

                        }

                    },

                    messages: {

                        new_res: {
                            required: "未輸入回覆內容",
                        }

                    }

                });

            });
            </script>
            <script type="text/javascript">
            $(document).ready(function() {

                $(".delete").click(function() {

                    var page = $("#cur").text();
                    var index = $(this).val();
                    var text = $("textarea").eq(index-1).text();
                    var type = $('input').eq((index - 1) * 3 + 1).val();
                    var time = $('input').eq(index * 3 - 3).val();
                    //alert(time);
                    var acc = $('span').eq(index - 1).text();
                    //alert(acc);
                    var a_id = $(this).get(0).id;
                    //alert(acc+" "+time+" "+text+" "+type);
                    $.ajax({
                        url: "article_del.php",
                        data: {
                            msg_time: time,
                            acc: acc,
                            page: page,
                            a_id: a_id,
                            type:type,
                        },
                        type: "POST",
                        dataType: "text",
                        /*beforeSend:function(){
                            //var text=$('.txt'+index).text();
                            
                        },*/
                        error: function() {
                            alert("刪除失敗");
                        },
                        complete: function() {
                            alert("刪除成功");
                            if(type==1)
                            	window.location.href = "boardarea.php";
                            else
                            	window.location.href = "article.php?id="+a_id+"&page="+page;
                        }
                    });

                });
            });
            </script>
            <script type="text/javascript">
            $(document).ready(function() {
                $(".edit").click(function() {

                    var index = $(this).val();
                    //alert($('textarea').eq(index-1).text());
                    $('textarea').eq(index - 1).removeAttr("readonly").removeClass('disable').addClass('editable').attr('id', 'edit_message').attr('name', 'edit_message');
                    $(".update").eq(index - 2).removeClass('hide');
                    $(".update").eq(index - 2).addClass('able');
                    $("form").eq(index - 1).removeClass('disable');

                });

                /*$(window.parent.document).find("#main").load(function(){
                    var main = $(window.parent.document).find("#main");
                    var thisheight = $(document).height()+50;
                    main.height(thisheight);
                });*/

            });
            </script>
            <style type="text/css">
            .error {
                color: #D82424;
                font-weight: normal;
                font-family: "微軟正黑體";
                display: block;
                padding: 1px;
            }
            
            .table {
                margin: auto;
            }
            
            .table-bordered > tbody > tr > td,
            .table-bordered > tfoot > tr > th {
                font-color: rgb(0, 0, 204);
                font-family: "微軟正黑體";
            }
            
            textarea {
                resize: none;
            }
            </style>
    </head>

    <body>
        <div id="wrapper">
            <?php
        $acc=$row['account'];
        $sql="SELECT nickname FROM member WHERE account='$acc'";
        $result=mysqli_query($link,$sql);
        $row_author=mysqli_fetch_assoc($result);

        $nickname_author=$row_author['nickname'];
    ?>
                <div class="row">
                    <div class="col-md-12  col-md-10 col-md-offset-1">
                        <div class="panel panel-primary">
                            <div class="panel-heading ">#1<?=$title?>
                            </div>
                            <div class="panel-body panel-height">
                                <form class="form-horizontal disable" role="form" method='POST' action='article_up.php'>
                                    <fieldset>
                                        <div class="form-group">
                                            <table class="table table-bordered col-md-8 col-md-offset-1">
                                                <tbody>
                                                    <tr>
                                                        <td class="col-md-3 col-md-offset-3 text-left">
                                                            <label>作者:
                                                                <?php echo$nickname_author."(".$row['account'].")";   ?>發表時間:
                                                                <?=$row['time']?>
                                                            </label>
                                                            <span type='hidden'><?=$row['account']?></span>
                                                            <input type='hidden' name='time' value='<?=$row['time']?>'></input>
                                                            <input type='hidden' name='type' value='1'></input>
                                                            <input type='hidden' name='a_id' value='<?=$a_id?>'></input>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <textarea class="form-inline form-control col-md-8 disable" rows="5" id="" name="author" value="1" readonly="true"><?=$row['text']?></textarea>
                                                        </td>
                                                    </tr>
                                                    <?php

                                                    $acc_log=@$_SESSION['user'];

                                                    $sql="SELECT level FROM member WHERE account='$acc_log'";
                                                    $result_log=mysqli_query($link,$sql);
                                                    $row_log=mysqli_fetch_assoc($result_log);

                                                    if(@$_SESSION['user']==$row['account'] || $row_log['level']==2)
                                                    {
                                                        echo"

                                                                <tr>
                                                                    <td>
                                                                        <button type='button' id='".$a_id."' class='btn btn-danger delete' >刪除</button>
                                                                    
                                                            ";
                                                    }
                                                    if(@$_SESSION['user']==$row['account'])
                                                    {
                                                        echo"

                                                                    <button class='btn btn-warning edit' value='1' type='button'>編輯</button>
                                                                    <button class='btn btn-warning update hide' type='submit'>修改完成</button>
                                                                </td>
                                                            </tr>
                                                            ";
                                                    }
                                                    else
                                                    {
                                                        echo"</td></tr>";
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- author row -->
                <?php

                            $sql="SELECT * FROM article_response WHERE a_id='$a_id'";

                            $result=mysqli_query($link,$sql);
                            $total_records=mysqli_num_rows($result);
                            

                            if($total_records>0)
                            {
                                $total_page=ceil($total_records/10);

                                mysqli_data_seek($result,($page-1)*10);

                                for($i=1;$i<=10;$i++)
                                {
                                    if($row=mysqli_fetch_assoc($result))
                                    {
                                        $acc=$row['account'];
                                        $sql="SELECT nickname FROM member WHERE account='$acc'";

                                        $result_response=mysqli_query($link,$sql);
                                        $row_response=mysqli_fetch_assoc($result_response);
                                        $nickname_response=$row_response['nickname'];

                                        $index=$i+1;
                                        $re_num=($page-1)*10+$i+1;
                                        echo"
                                            <div class='row'>
                                                <div class='col-md-10 col-md-offset-1'>
                                                    <div class='panel panel-primary'>
                                                        <div class='panel-heading '>#".$re_num." RE:".$title."</div>
                                                            <div class='panel-body panel-height'>
                                                                <form class='form-horizontal disable' role='form' method='POST' action='article_up.php'>
                                                                    <fieldset>
                                                                        <div class='form-group'>
                                                                            <table class='table table-bordered col-mcol-md-offset-1'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class='col-mcol-md-offset-3 text-left'>
                                                                                            <label>作者:".$nickname_response
                                                                                            ."(".$row['account'].")發表時間:".$row['time']."</label>
                                                                                            <span type='hidden'>".$row['account']."</span>
                                                                                            <input type='hidden' name='time' value='".$row['time']."' ></input>
                                                                                            <input type='hidden' name='type' value='2' ></input>
                                                                                            <input type='hidden' name='a_id' value='".$a_id."' ></input>
                                                                                        </td>
                                                                                    </tr>
                                                
                                                                                    <tr>
                                                                                        <td>
                                                                                        <textarea class='form-inline form-control col-md-8 disable' rows='5' id='' name='response' readonly='true'>".$row['text']."</textarea>
                                                                                        </td>
                                                                                    </tr>";

                                                                                    if(@$_SESSION['user']==$row['account'] || $row_log['level']==2)
                                                                                    {
                                                                                        echo"

                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <button type='button' class='btn btn-danger delete' value='".$index."' id='".$a_id."'>刪除</button>
                                                                                                    
                                                                                            ";
                                                                                    }
                                                                                    if(@$_SESSION['user']==$row['account'])
                                                                                    {
                                                                                        echo"

                                                                                                    <button class='btn btn-warning edit' type='button' value='".$index."'>編輯</button>
                                                                                                    <button class='btn btn-warning update hide' type='submit'>修改完成</button>
                                                                                                </td>
                                                                                            </tr>
                                                                                            ";
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo"</td></tr>";
                                                                                    }
                                                                                echo"
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            ";
                                    }
                                    
                                }
                            }
                            
                          ?>
                    <div class="row">
                    	<div class=" col-md-10 col-md-offset-1">
                    		<div class="panel panel-primary">
                    		    <div class="panel-heading text-center">RE:<?=$title?></div>
                    		    	<div class="panel-body panel-height">
                    		        	<form class="form-horizontal" role="form" id="form_article" method='POST' action='new_response.php'>
                    		            	<fieldset>
                    		                	<div class="form-group">
                    		                		<div class="col-sm-5">留言回覆本文章:</div>
                    		                		<div class="col-md-12">
                    		                			<textarea style="margin-bottom:20px;" class="form-inline form-control col-md-8" id="new_res" name="new_res" rows="5"></textarea>
                    		                		</div>
                    		                		<input name="res_aid" type="hidden" value="<?=$a_id?>"></input>
                    		                		<div class="row text-center" >
                    		                			<button type="sumbit" id="<?=$a_id?>" value="<?=$index?>" class="btn btn-success new">回覆</button>
                    		                		</div>
                    							</div>
                    						</fieldset>
                    					</form>
                    				</div>
                   			</div>
                   		</div>
                   	</div>

                    <div style="margin-bottom:120px;"></div>

                    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
                    	<div class="row">               
                    		        <div class="text-center">

                    		        	<a class="btn btn-info" href='boardarea.php'><i class='fa fa-reply ' aria-hidden='true'></i>文章列表</a>
                    		        
                    		            <?php

                    		    if($total_records!=0)
                    		    {
                    		        $pre_page=$page-1;
                    		        $next_page=$page+1;

                    		        if($page!=1)
                    		            echo "<a class='btn btn-info'"."href='article.php?page=".$pre_page."&id=".$a_id."'><</a>";
                    		        else
                    		            echo "<a class='btn btn-danger disabled'><</a>";

                    		        for($i=1;$i<=$total_page;$i++)
                    		        {

                    		            if($i==$page)
                    		                echo"<a class='btn btn-primary' id='cur'>".$i."</a>";
                    		            else
                    		                echo "<a class='btn btn-info'"."href='article.php?page=".$i."&id=".$a_id."'>".$i."</a>";
                    		        }

                    		        if($page!=$total_page)
                    		            echo "<a class='btn btn-info'"."href='article.php?page=".$next_page."&id=".$a_id."'>></a>";
                    		        else
                    		            echo "<a class='btn btn-danger disabled'>></a>";
                    		    }
                    		    
                    		
                    		?>
                    		        </div>
                    	</div>
                        
                    </nav>
                    <!--<div class="form-group">
                              <div class="row">
                                  <div class="col-sm-2 col-sm-offset-3">
                                      <label>
                                          <button type="submit" class="btn btn-primary">資料送出</button>
                                      </label>
                                  </div>
                                  <div class="col-sm-2 col-sm-offset-1">
                                      <label>
                                          <button type="reset" class="btn btn-warning">重新填寫</button>
                                      </label>
                                  </div>
                              </div>
                          </div>-->
        </div>
        <!-- /#wrapper -->
    </body>

    </html>
