<?php    
                 $sel = @($_POST['type']);
                 if($sel == 1){
            ?>
            <input type="button" value="確認" onclick="location.href='CRUDBook.php'" class="btn btn-primary">
            <?php } else if($sel == 2){
            ?>
            <input type="button" value="確認" onclick="location.href='CRUD_3C.php'" class="btn btn-primary">
            <?php }else if($sel == 3){
            ?>
            <input type="button" value="確認" onclick="location.href='CRUD_game.php'" class="btn btn-primary">
            <?php } 
?>