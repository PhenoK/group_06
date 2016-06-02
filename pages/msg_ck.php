<?php
			include_once('connect.php');

            mysqli_query($link,'SET CHARACTER SET utf8');
            mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");

            $index=$_POST;
            $page=$index;
            

            
            if($result = mysqli_query($link, "SELECT * FROM product_review ORDER BY id DESC"))
            {

                $total_records=mysqli_num_rows($result);
                $total_page=ceil($total_records/5);

                $result=mysqli_query($link,"SELECT * FROM product_review ORDER BY id DESC");
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
                                <div class='col-md-12' id='msg_area'>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star-o'></span> 留言者帳號:".$acc." 暱稱: ".$nickname.
                                    "<span class='pull-left> 發表留言時間: ".$time."</span>
                                    <pre style='background-color:white;'>".$text."</pre>
                                </div>
                            ";
                    }
                    else
                        break;
                   
                }

                mysqli_free_result($result);
            }


          ?>