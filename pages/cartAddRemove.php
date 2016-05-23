<script>
function cart(add_remove, id) {
  $.ajax({
    url: 'cartAddRemove_ajax.php',
    data: {
      // 1: add 2: remove
      oper: add_remove,
      id: id
    },
    type: 'GET',
    dataType: "json",
    success: function(Jdata) {
      // 依據取得(從主頁面product.php)的id判斷
      // 物品已在購物車
      if (jQuery.inArray(id.toString(), Jdata) >= 0){
          $("#p" + id).html("<i class=\"fa fa-shopping-cart fa-fw\"></i> 取消購物車");
          $("#p" + id).attr("onclick", "cart(2," + id +")");
      }
      else {
          $("#p" + id).html("<i class=\"fa fa-shopping-cart fa-fw\"></i> 加入購物車");
          $("#p" + id).attr("onclick", "cart(1, "+ id +")");
      }
      $("#cart_cnt").html(Jdata.length);//顯示購物車物品數量
    },
    error: function(xhr, ajaxOptions, thrownError) {

    }
  });
}
</script>
<?php
const ADD = 1;
const REMOVE = 2;
// 決定傳入onclick的參數與button字樣中的動作
if (in_array("$id", $arr_cart)){
  $cart_func_oper = REMOVE;
  $cart_btn_oper = "取消";
}
else {
  $cart_func_oper = ADD;
  $cart_btn_oper = "加入";
}
 ?>
