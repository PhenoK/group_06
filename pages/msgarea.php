<!DOCTYPE html>
<html>

<head>
    <?php 
        include('head.php');
        include_once('initial.php');
        include_once('connect.php');
    ?>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript"  src="additional-methods.min.js"></script>

    <script>
    $(document).ready(function($) {

        jQuery.validator.addMethod("none", function(value, element) {
            return value.split(" ").length - 1 < value.length;
        }, "請勿輸入空白內容");

        $(".enable").validate({
            submitHandler: function(form) {

                $(form).ajaxSubmit({
                    type: "POST",
                    url: "msg_up.php",
                    dataType: "text",
                    data: $('#edit_message').text(),

                });

            },


            rules: {

                edit_message: {

                    none: true,
                    required: true,

                }

            },

            messages: {

                edit_message: {
                    required: "請輸入留言",
                }

            }

        });

    });
    </script>

    <script type="text/javascript">

        $(document).ready(function() {
           
            $(".delete").click(function() {

                var page=$("#cur").text();
                var index = $(this).val()*8;
                var time = $('span').eq(index-7).text();
                var acc = $('span').eq(index-1).text();
                var id=$(this).get(0).id;

                $.ajax({
                            url : "msg_del.php",
                            data : {msg_time:time,acc:acc},
                            type : "POST",
                            dataType : "text",
                            /*beforeSend:function(){
                                var text=$('.txt'+index).text();
                                alert(acc);
                            },*/
                            error : function(){
                                alert("刪除失敗");
                            },
                            success : function($result){
                                $(".msg_area").load("msgarea.php?page="+page+"&id="+id);
                                alert("刪除成功");
                            }
                });
                
            });
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function() {
            $(".edit").click(function() {

                var index=$(this).val();
                $('textarea').eq(index-1).removeAttr("readonly").removeClass('rdoy').addClass('editable').attr('id','edit_message').attr('name','edit_message');
                $(".update").eq(index-1).removeClass('hide');
                $(".update").eq(index-1).addClass('able');
                $("form").eq(index-1).removeClass('rdoy');
                
            });


        });
    </script>

    


    <style>
        textarea{
            resize: none;
        }    
    </style>

</head>

<body>
    <?php


        if(@$_GET['page'])
          $page=$_GET['page'];
        else
          $page=1;

        $id=@$_GET['id'];

        mysqli_query($link,'SET CHARACTER SET utf8');
        mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");


        if($result = mysqli_query($link, "SELECT * FROM product_review WHERE product_id='$id' ORDER BY id DESC"))
        {

            $total_records=mysqli_num_rows($result);
            if($total_records!=0)
            {
                $total_page=ceil($total_records/5);

                mysqli_data_seek($result,($page-1)*5);
                
                echo"<div class='msg_area'>";
                for($i=1;$i<=5;$i++)
                {
                    if($row = mysqli_fetch_assoc($result))
                    {
                        
                        $acc=$row['account'];
                        $res_nick=mysqli_query($link, "SELECT nickname FROM member WHERE '$acc'=account");
                        $acc_log=@$_SESSION['user'];
                        $result_lv=mysqli_query($link, "SELECT level FROM member WHERE '$acc_log'=account");
                        $res_level=mysqli_fetch_assoc($result_lv);
                        $res_lv=$res_level['level'];
                        $row_nick=mysqli_fetch_assoc($res_nick);
                        $nickname=$row_nick['nickname'];
                        $time=$row['time'];
                        $text=$row['text'];
                        echo"
                            
                                <div class='col-md-12'>
                                    <div class='row'>
                                        <span> 發表留言時間: </span><span id='msg_time' >".$time."</span> 評價:
                                        <span class='fa fa-star'></span>
                                        <span class='fa fa-star'></span>
                                        <span class='fa fa-star'></span>
                                        <span class='fa fa-star'></span>
                                        <span class='fa fa-star-o'></span> 留言者帳號:<span>".$acc."</span> 暱稱: ".$nickname
                                        ."";

                        if($acc==@$_SESSION['user'])
                        {
                            echo "
                                            <div class='pull-right' style='margin-bottom:10px;'>
                                                <button type='button' class='btn btn-danger delete' value='".$i."' id='".$id."' >刪除</      button>
                                                <button class='btn btn-warning edit' type='button' value='".$i."' >編輯</button>
                                                
                                            </div>
                                        </div>
                                        <form role='form' class='rdoy' id='content' method='POST' action='msg_up.php'>
                                            <textarea readonly='true' class='form-control txt".$i."' name= 'message' id='accessable' style='background-color:white; margin-bottom:10px; '>".$text."</textarea>
                                            <button class='btn btn-warning update hide' id='".$id."' type='submit' value='".$i."' >修改完成</button>
                                            <input type='hidden' name='time' value='".$time."' ></input>
                                        </form> 
                                    </div>  
                                ";//onclick='msg_edit()' pointer-events: none;
                        }
                        else if($res_lv==2)
                        {
                            echo "
                                            <div class='pull-right' style='margin-bottom:10px;'>
                                                <button type='button' class='btn btn-danger delete' value='".$i."' id='".$id."' >刪除</button>                                       
                                            </div>
                                        </div>
                                        <form role='form' class='rdoy' id='content' method='POST' action='msg_up.php'>
                                            <textarea readonly='true' class='form-control txt".$i."' name= 'message' id='accessable' style='background-color:white; margin-bottom:10px; '>".$text."</textarea>
                                            <input type='hidden' name='time' value='".$time."' ></input>
                                        </form> 
                                    </div>  
                                ";
                        }
                        else
                        {
                            echo "
                                            </div>
                                        <textarea readonly='true' class='form-control'  style='background-color:white;'>".$text."</textarea>
                                    </div> 
                                ";
                        }
                        
                    }
                    else
                    {
                        break;
                    }
                }
            }

            mysqli_free_result($result);
        }

        if($total_records==0)
        {
            echo "<h2>目前尚無商品留言</h2>";
        }
        


    ?>

    <hr>
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="text-center">
            <?php
                if($total_records!=0)
                {
                    for($i=1;$i<=$total_page;$i++)
                    {
                        if($i==$page)
                            echo"<a class='btn btn-primary' id='cur'>".$i."</a>";
                        else
                            echo "<a class='btn btn-info'"."href='msgarea.php?page=".$i."&id=".$id."'>".$i."</a>";
                    }
                }
                
    
            ?>
        </div>
    </nav>
    </div>
</body>

</html>
