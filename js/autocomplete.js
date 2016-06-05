$(document).ready(function(){
  $('#item_name').autocomplete({
    source: 'auto_search.php',
    minLength: 1
  });

  $('#search_form').submit(function(){
    if ($('#price_min').val() == ''){
      $('#price_min').val(0);
    }
    if ($('#price_max').val() == ''){
      $('#price_max').val(99999);
    }

    var sub = $('#item_name').val();
    $('#item_name').val(sub.substring(0, 20));

    return true;
  });
});
