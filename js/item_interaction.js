let $lastClicked;
let order_id = null;    
const v_price = document.getElementById('v_price');
const v_stock = document.getElementById('variant_stock');
const v_order = document.getElementById('variant_order');
const order_qty = document.getElementById("order_qty");


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
    v_order.name = "variant_order["+order_id+"]";
    order_qty.name = v_order.name + "[qty]";

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

const interact_button = document.getElementById("interact_button");
const item_interaction_cart = document.getElementById("item_interaction_cart");
const item_interaction_order = document.getElementById("item_interaction_order");

$(item_interaction_order).on("click", function(){
    interact_button.value = "Buy";
});

$(item_interaction_cart).on("click", function(){
    interact_button.value = "Add To Cart";
});

$("#variant_order_data").on('submit', function(event) {
    if (order_id === null) {
        event.preventDefault();
        Swal.fire({
            icon: "error",
            title: "Please Select an item",
        });
    }

    if(interact_button.value === "Add To Cart"){
        event.preventDefault();
        $.ajax({
            url: "../db_api/db_add_cart.php",
            type: "POST",
            data:{variant_id:order_id},
            success:function(page){
                Swal.fire({
                    icon: "success",
                    title: "Added to cart",
                });
            }
        })
    }
});
