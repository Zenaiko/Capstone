let $lastClicked;
const v_price = document.getElementById('v_price');
const variant_stock = document.getElementById('variant_stock');


$('.variant').on('click', function() {

    if ($lastClicked) {
      
        if ($lastClicked[0] === this) {
           
            $lastClicked.css('border', 'none');
            $lastClicked = null; 
            $order_id = null;
            return;
        } else {
            $lastClicked.css('border', 'none');
            $lastClicked = null;  
            $order_id = null;
        }
    }
    
    $lastClicked = $(this);
    $lastClicked.css('border', '2px solid black');
    $order_id =  $(this).attr('id');

    $.ajax({
        url: '../db_api/db_get_ajax.php',
        type: 'POST',
        data: {var_id: $order_id},
        success: function(order_json){
            const order_array = JSON.parse(order_json);
            v_price.innerHTML = '₱' + order_array.vairation_price;
            // item_stock.innerHTML = order_array["variation_stock"]

        }
    })


});

$('#buy_button').on('click' , function(){
    if ($order_id === null){
        Swal.fire({
            icon: "error",
            title: "Please Select an item",
          });
    }
});
