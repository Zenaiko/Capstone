<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <title>Cart Page</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>

<?php 
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once("../utilities/initialize.php"); 
require_once("../db_api/db_get.php"); 
if($_SESSION["user"] === "visitor" OR !isset($_SESSION["cus_id"])){
    $_SESSION["error"] = "sign_up";
    header("location: ../");
}
?>

<!-- Navbar -->
<nav id="navbar">
    <button id="backButton" class="navbar-button"  onclick="window.history.back()">Back</button>
    <button id="editButton" class="navbar-button">Edit</button>
</nav>

<?php if(!is_null($get_db->get_cart($_SESSION["cus_id"]))){ ?>

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
            echo '<div class="seller_cart_wrapper">';
            echo '<div class="seller_cart_contents">';
            echo '<div class="seller_cart_name_container">';
            echo '<input  type="checkbox" class="cart_seller_checkbox">';
            echo '<p class="seller_cart_name">' . htmlspecialchars($cart_info["market_name"]) . '</p>';
            echo '<span class="delete-store"><i class="bi bi-trash"></i></span>';
            echo '</div>';
            echo '<div class="seller_items_wrapper">';
    
            array_push($exist_market, $cart_info["market_id"]);
        }
        // Seller item block
        echo '<div class="seller_item">';
        echo '<input type="checkbox" value="'. $cart_info["variation_id"]  .'" class="item_cart_checkbox">';
        echo '<img src="'. ($cart_info['item_img']??"../assets/tmp.png") .'" alt="Item Image" class="item_cart_img">';
        echo '<div class="cart_item_description">';
        echo '<p class="item_cart_name">' . htmlspecialchars($cart_info["item_name"]) . ' (' . htmlspecialchars($cart_info["variation_name"]) . ')</p>';
        echo '<p class="item_cart_price">₱' . htmlspecialchars(number_format($cart_info["cart_price"])) . '</p>';
        echo '</div>';
        echo '<div class="item_counter_wrapper">';
        echo '<div class="item_counter">';
        echo '</div>';
        echo '<i class="bi bi-dash"></i>';
        echo '<input class="cart_item_qty" value=1 name="variant_order['.$cart_info["variation_id"]. '][qty]">';
        echo '<i class="bi bi-plus"></i>';
        echo '<span class="delete-item"><i class="bi bi-trash"></i></span>';
        echo '</div>';
        echo '</div>';
    }
    if (!empty($exist_market)) {
        // Close last market's divs
        echo '</div></div>'; // Close seller_items_wrapper and seller_cart_contents
        echo '</div>'; // Close seller_cart_wrapper
    }
    ?>
        </section>
        <!-- Center Button Container -->
        <div class="center-button-container">
            <button class="btn btn-primary" id="checkoutButton">Checkout</button>
        </div>
</form>


    <script src="../js/cart.js"></script>

    <?php }else{
        echo "No items in the cart";
    } ?>
</body>
</html>
