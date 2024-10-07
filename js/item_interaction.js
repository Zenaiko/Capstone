let $lastClicked;
let order_id = null;    
const v_price = document.getElementById('v_price');
const v_stock = document.getElementById('variant_stock');
const v_order = document.getElementById('variant_order');

$('.variant').on('click', function() {
    if ($lastClicked) {
        if ($lastClicked[0] === this) {
            $lastClicked.css('border', 'none');
            $lastClicked = null; 
            order_id = null; // Clear order_id
            v_order.value = ''; // Clear the input value
            return;
        } else {
            $lastClicked.css('border', 'none');
        }
    }
    
    $lastClicked = $(this);
    $lastClicked.css('border', '1px solid black');
    order_id = $(this).attr('id');
    v_order.value = order_id; // Set the value

    $.ajax({
        url: '../db_api/db_get_ajax.php',
        type: 'POST',
        data: {var_id: order_id},
        success: function(order_json) {
            const order_array = JSON.parse(order_json);
            v_price.textContent = '₱' + order_array.variation_price;
            v_stock.textContent = 'Stock: ' + order_array.variation_stock;
        }
    });
});

var order_dir = 'cus_checkout.php';

$('#buy_button').on('click', function(event) {
    if (order_id === null) {
        event.preventDefault();
        Swal.fire({
            icon: "error",
            title: "Please Select an item",
        });
    }
});
