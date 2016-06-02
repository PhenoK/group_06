<!DOCTYPE html>
<html>

<head>
    <?php 
        include('head.php');
        include_once('initial.php');
        include_once('connect.php');
    ?>
    <script type="text/javascript">
        var msg_del=function(){
        var time=$("#msg_time").text();
            $.ajax({
                    url : "msg_del.php",
                    data : {msg_time:time},
                    type : "POST",
                    dataType : "text",
                    error : function(){
                         alert("刪除失敗");
                    },
                    success : function(){
                         $(".msg_area").load('msgarea.php');
                         alert("刪除成功");
                    }
            });
        }
        
    </script>

    <script type="text/javascript">
        /*var msg_edit=function(){
        var time=$("#msg_time").text();
            $.ajax({
                    url : "msg_del.php",
                    data : {msg_time:time},
                    type : "POST",
                    dataType : "text",
                    error : function(){
                         alert("刪除失敗");
                    },
                    success : function(){
                         $("#msg_area").load('msgarea.php');
                         alert("成功");
                    }
            });
        }*/
        $(document).ready(function() {
            $(".edit").click(function() {
                var index=$(this).val();
                $('textarea').eq(index).removeAttr("readonly");
                alert(index);
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

        mysqli_query($link,'SET CHARACTER SET utf8');
        mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");

        if($result = mysqli_query($link, "SELECT * FROM product_review ORDER BY id DESC"))
        {

            $total_records=mysqli_num_rows($result);
            $total_page=ceil($total_records/5);

            mysqli_data_seek($result,($page-1)*5);
    
            for($i=1;$i<=5;$i++){
                if($row = mysqli_fetch_assoc($result)){
    
                    $acc=$row['account'];
                    $res_nick=mysqli_query($link, "SELECT nickname FROM member WHERE '$acc'=account");
                    $row_nick=mysqli_fetch_assoc($res_nick);
                    $nickname=$row_nick['nickname'];
                    $time=$row['time'];
                    $text=$row['text'];
                    echo"
                        <div class='msg_area".$i."'>
                            <div class='col-md-12'>
                            <div class='row'>
                            <span> 發表留言時間: </span><span id='msg_time'>".$time."</span> 評價:
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star-o'></span> 留言者帳號:".$acc." 暱稱: ".$nickname
                            
                            
                        ;

                    if($acc==@$_SESSION['user'])
                    {
                        echo "
                                <div class='pull-right' style='margin-bottom:10px;'>
                                    <button type='button' class='btn btn-danger' id='msg_del' onclick='msg_del()'>刪除</button>
                                    <button class='btn btn-warning edit' id='msg_edit' value='".$i."' >編輯</button>
                                </div>
                                </div>
                                <form><textarea readonly class='form-control txt'".$i." id='accessable' style='background-color:white; margin-bottom:10px; '>".$text."</textarea>
                                </div>
                                
                                ";//onclick='msg_edit()' pointer-events: none;
                    }
                    else
                    {
                        echo "
                                        </div>
                                    <textarea  style='background-color:white;'>".$text."</textarea>
                                </div>
                                
                                ";
                    }
                    
                }
                else
                  break; 
              
            }

            mysqli_free_result($result);
      }
    ?>
    </div>
    <hr>
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <div class="text-center">
    <?php
        for($i=1;$i<=$total_page;$i++)
        {
            if($i==$page)
                echo"<a class='btn btn-primary'>".$i."</a>";
            else
                echo "<a class='btn btn-info'"."href='msgarea.php?page=".$i."'>".$i."</a>";
        }

    ?>
    </div>
    </nav>
</body>

</html>
