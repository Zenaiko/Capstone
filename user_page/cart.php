<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <title>Cart Page</title>
</head>
<body>

    <?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once("../utilities/initialize.php"); 
    require_once("../db_api/db_get.php"); 
    ?>

    <!-- Navbar -->
    <nav id="navbar">
        <button id="backButton" class="navbar-button" onclick="window.history.back()">Back</button>
    </nav>

    <form action="cus_checkout.php" method="post">
        <section id="cart_section">
    
        <?php
        $exist_market = array();
        foreach($get_db->get_cart($_SESSION["cus_id"]) as $cart_info) {
            if (!in_array($cart_info["market_id"], $exist_market)) {
                if (!empty($exist_market)) {
                    // Close previous market's divs
                    echo '</div></div>'; // Close seller_items_wrapper and seller_cart_contents
                    echo '</div>'; // Close seller_cart_wrapper
                }
                // Start new market wrapper
                echo '<div class="seller_cart_wrapper" data-market-id="'. $cart_info["market_id"] .'">';
                echo '<div class="seller_cart_contents">';
                echo '<div class="seller_cart_name_container">';
                echo '<p class="seller_cart_name">' . htmlspecialchars($cart_info["market_name"]) . '</p>';
                echo '</div>';
                echo '<div class="seller_items_wrapper">';

                array_push($exist_market, $cart_info["market_id"]);
            }
            // Seller item block (no checkboxes anymore)
            echo '<div class="seller_item" id="item-'.$cart_info["variation_id"].'">';
            echo '<img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">';
            echo '<div class="cart_item_description">';
            echo '<p class="item_cart_name">' . htmlspecialchars($cart_info["item_name"]) . ' (' . htmlspecialchars($cart_info["variation_name"]) . ')</p>';
            echo '<p class="item_cart_price">' . htmlspecialchars($cart_info["cart_price"]) . '</p>';
            echo '</div>';
            echo '<div class="item_counter_wrapper">';
            echo '<i class="bi bi-dash" onclick="updateQuantity(this, -1)"></i>';
            echo '<input class="cart_item_qty" value="1" name="variant_order['.$cart_info["variation_id"].'][qty]" data-id="'.$cart_info["variation_id"].'" oninput="checkQuantity(this)">';
            echo '<i class="bi bi-plus" onclick="updateQuantity(this, 1)"></i>';
            echo '<button type="button" class="delete-item-btn" onclick="deleteItem(this, '. $cart_info["variation_id"] .')"><i class="bi bi-trash"></i></button>'; // Trashcan icon for deletion
            echo '</div>';
            echo '</div>';
        }
        if (!empty($exist_market)) {
          
            echo '</div></div>'; 
            echo '</div>'; 
        }
        ?>
        </section>

        <div class="center-button-container">
            <button class="btn btn-primary" id="checkoutButton">Checkout</button>
        </div>
    </form>

    <script src="../js/cart.js"></script>

</body>
</html>
