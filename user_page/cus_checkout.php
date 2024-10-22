<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/customer_checkout.css">
</head>
<body>

    <?php 
        require_once('../utilities/initialize.php');
        require_once('../db_api/db_item_info.php');
        require_once('../db_api/db_checkout.php');
     ?>

<form action="../db_api/db_checkout.php" id="order_rqst_form" method="post">
        <div class="checkout-container">
            <!-- Header -->
            <header class="checkout-header">
                <button class="back-btn">←</button>
                <h1>Checkout</h1>
            </header>
    
            <!-- Shipping Section -->
            <section class="section">
                <h2 class="section-title">Shipping Information</h2>
                <div class="section-content">
                    <p>The Hotdog Seller</p>
                    <p>1234 Street Name, City</p>
                    <p>0999999</p>
                </div>
            </section>
    
            <!-- Cart Items Section -->
            <section class="section">
                <h2 class="section-title">Order</h2>
                
            <?php foreach($order_info->get_order_info() as $var_id => $var_info){ ?>
                <input type="text" hidden name="variant_order[<?=$var_info["id"]?>]" value="<?=$var_info["id"]?>">
                <div class="cart-item">
                    <img src="../assets/tmp.png" alt="" class="item-img">
                    <div class="item-info">
                        <p class="item-name"><?=$var_info["item_name"]."(".$var_info["name"].")"?></p>
                        <div class="qty_order_container">
                            <p class="item-qty">Qty:</p>
                            <input type="number"value="<?=$var_info["qty"]?>" class="order_qty_form" readonly name="variant_order[<?=$var_info["id"]?>][qty]" id="">
                        </div>
                    </div>
                    <p class="item-price">₱<?=$var_info["price"]?></p>
                </div>
            <?php } ?>
               
            </section>
    
            <!-- Order Summary Section -->
            <section class="section">
                <h2 class="section-title">Order Summary</h2>
                <div class="summary-item">
                    <span>Order Subtotal</span>
                    <span id="order_subtotal"></span>
                </div>
                <div class="summary-item">
                    <span>Shipping Fee</span>
                    <span id="shipping_fee">₱5.10</span>
                </div>
                <div class="summary-item total">
                    <span>Total Payment</span>
                    <span id="total_payement"></span>
                </div>
            </section>
    
            <!-- Checkout Button -->
            <input type="submit" id="order_submit" name="order_submit" class="checkout-btn" value="Place Order">
        </div>
</form>

    <script src="../js/order.js"></script>

</body>
</html>


