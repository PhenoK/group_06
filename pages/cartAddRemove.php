<script>
function cart(add_remove, id, price) {
  $.ajax({
    url: 'cartAddRemove_ajax.php',
    data: {
      // 1: add 2: remove
      oper: add_remove,
      id: id,
      price: price
    },
    type: 'GET',
    dataType: "json",
    success: function(Jdata) {
      // 依據取得(從主頁面product.php)的id判斷
      // 物品已在購物車
      if (jQuery.inArray(id.toString(), Jdata) >= 0){
          $("#p" + id).html("<i class=\"fa fa-cart-arrow-down fa-fw\"></i> 取消購物車");
          $("#p" + id).attr("onclick", "cart(2," + id + "," + price + ")");
      }
      else {
          $("#p" + id).html("<i class=\"fa fa-cart-plus fa-fw\"></i> 加入購物車");
          $("#p" + id).attr("onclick", "cart(1, "+ id + "," + price + ")");
      }
      // 因為回傳的還有購物車總金額，故實際購物車品項數量還要再少1
      // 顯示購物車物品數量
      $("#cart_cnt").html(Jdata.length - 1);
      // 回傳中最後一個資料即為購物車總金額
      $("#cart_price").html("<i class=\"fa fa-usd fa-fw\"></i>" + Jdata[Jdata.length - 1]);
      /* 原本總金額是直接取$_COOKIE，但在此處取的COOKIE是頁面一開始的COOKIE，而非實際上的COOKIE */
    },
    error: function(xhr, ajaxOptions, thrownError) {

    }
  });
}
</script>
<?php
// 決定傳入onclick的參數與button字樣中的動作
if (@in_array("$id", $arr_cart)){
  $cart_func_oper = REMOVE;
  $cart_btn_oper = "取消";
}
else {
  $cart_func_oper = ADD;
  $cart_btn_oper = "加入";
}
 ?>
