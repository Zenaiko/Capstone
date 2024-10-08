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

    <?php require_once('../db_api/db_item_info.php');
        require_once('../db_api/db_checkout.php');
     ?>

<form action="../db_api/db_checkout.php" method="post">
        <input type="text" hidden name="item_order" value="<?=$_POST["item_order"]?>" id="">
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
               
            <?php foreach($order_info->get_variant_info() as $var_id => $var_info){  ?>
                <input type="text" hidden name="variant_order[]" value="<?=$var_info["id"]?>">
                <div class="cart-item">
                    <img src="../assets/tmp.png" alt="Item 1" class="item-img">
                    <div class="item-info">
                        <p class="item-name"><?=$var_info["name"]?></p>
                        <p class="item-qty">Qty:</p>
                        <input type="number" name="order_qty[<?=$var_info["id"]?>]" id="<?=$var_info["id"]?>">
                    </div>
                    <p class="item-price">₱<?=$var_info["price"]?></p>
                </div>

            <?php } ?>
    
                <!-- <div class="cart-item">
                    <img src="item1.jpg" alt="Item 1" class="item-img">
                    <div class="item-info">
                        <p class="item-name">Item 1</p>
                        <p class="item-qty">Qty: 2</p>
                    </div>
                    <p class="item-price">₱20.00</p>
                </div>
                <div class="cart-item">
                    <img src="item2.jpg" alt="Item 2" class="item-img">
                    <div class="item-info">
                        <p class="item-name">Item 2</p>
                        <p class="item-qty">Qty: 1</p>
                    </div>
                    <p class="item-price">₱30.00</p>
                </div> -->
            </section>
    
            <!-- Order Summary Section -->
            <section class="section">
                <h2 class="section-title">Order Summary</h2>
                <div class="summary-item">
                    <span>Items Subtotal</span>
                    <span>₱50.00</span>
                </div>
                <div class="summary-item">
                    <span>Shipping Fee</span>
                    <span>₱5.00</span>
                </div>
                <div class="summary-item total">
                    <span>Total</span>
                    <span>₱55.00</span>
                </div>
            </section>
    
            <!-- Checkout Button -->
            <input type="submit" id="order_submit" name="order_submit" class="checkout-btn" value="Place Order">
        </div>
</form>

    <script src="../js/order.js"></script>

</body>
</html>
