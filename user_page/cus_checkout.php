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
        require_once('../utilities/back_button.php');
        require_once('../utilities/initialize.php');
        require_once('../db_api/db_checkout.php');
    ?>

    <form action="" id="order_rqst_form" method="post">
        <div class="checkout-container">

            <!-- Shipping Section -->
            <section class="section">
    <?php if(!is_null($pickup_info->get_pickup_id()) && $pickup_info->get_pickup_id() !== ""){ ?>
        <input type="text" hidden name="pickup_id" value="<?=$pickup_info->get_pickup_id()?>" id="pickup_id">
        <h2 class="section-title">Shipping Information</h2>
        <div class="section-content">
            <p class="fw-bold" id="pickup-name"><?=$pickup_info->get_pickup_name()?></p>
            <p id="recipient-name"><?=$pickup_info->get_recipient()?></p>
            <p id="shipping-address"><?=$pickup_info->get_full_address()?></p>
            <p id="contact">(<?=$pickup_info->get_contact()?>)</p>
        </div>
        <!-- Trigger for Off-Canvas -->
        <button type="button" id="address_change" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addressOffCanvas" aria-controls="addressOffCanvas">Change</button>
    <?php }else{ echo "No Address Set"; } ?>
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

            <!-- Off-Canvas -->
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="addressOffCanvas" aria-labelledby="addressOffCanvasLabel">
            <div class="offcanvas-header">
                <h5 id="addressOffCanvasLabel" class="mb-0">Change Shipping Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form id="address_form">
                    <div id="saved_addresses">
                        
                        <div class="form-check mb-3 p-3 border rounded position-relative">
                            <input class="form-check-input position-absolute" type="radio" name="address" id="address_1" data-pickup="Home" data-recipient="Rayleigh" data-contact="09" data-address="Cabanatuan City, Sampaguita">
                            <label class="form-check-label" for="address_1">
                                <div><strong>Pickup Name:</strong> Home</div>
                                <div><strong>Recipient:</strong> Rayleigh</div>
                                <div><strong>Contact:</strong> 09</div>
                                <div><strong>Address:</strong> Cabanatuan City, Sampaguita</div>
                            </label>
                        </div>

                        <div class="form-check mb-3 p-3 border rounded position-relative">
                            <input class="form-check-input position-absolute" type="radio" name="address" id="address_2" data-pickup="Office" data-recipient="Lucy" data-contact="09123456789" data-address="Makati City, Ayala Ave">
                            <label class="form-check-label" for="address_2">
                                <div><strong>Pickup Name:</strong> Office</div>
                                <div><strong>Recipient:</strong> Lucy</div>
                                <div><strong>Contact:</strong> 09123456789</div>
                                <div><strong>Address:</strong> Makati City, Ayala Ave</div>
                            </label>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Save Address</button>
                    </div>
                </form>
            </div>
        </div>




        <script src="../js/order.js" defer></script>


</body>
</html>
