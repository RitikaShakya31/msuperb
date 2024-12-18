<?php
if ($all_data != '') {

    foreach ($all_data as $row) {
        echo '<div class="col">';
        product($row, 'normal');
        echo '</div>';
    }
}
else
{
    echo '<img src="'.base_url().'assets/img/no.png" style="width: 100%;">';
} ?>

<script>
      
$(".action-plus").on("click", function() {
    var e = $(this).closest(".product-action").children(".action-input").get(0);
    var currentValue = parseInt(e.value);
    e.value = currentValue + 1;
  
    var c = $(this).closest(".product-action").children(".action-minus");
    if (currentValue + 1 > 1) {
      c.removeAttr("disabled");
    }
  });
  
  $(".action-minus").on("click", function() {
    var inputElement = $(this).closest(".product-action").children(".action-input").get(0);
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
      inputElement.value = currentValue - 1;
      if (currentValue - 1 === 1) {
        $(this).attr("disabled", "disabled");
      }
    }
  });
  
</script>