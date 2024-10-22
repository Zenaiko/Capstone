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
        <button id="backButton" class="navbar-button">Back</button>
        <button id="editButton" class="navbar-button">Edit</button>
    </nav>

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
        echo '<input type="checkbox" class="cart_seller_checkbox">';
        echo '<p class="seller_cart_name">' . htmlspecialchars($cart_info["market_name"]) . '</p>';
        echo '<span class="delete-store"><i class="bi bi-trash"></i></span>';
        echo '</div>';
        echo '<div class="seller_items_wrapper">';
        
        array_push($exist_market, $cart_info["market_id"]); 
    }
    // Seller item block
    echo '<div class="seller_item">';
    echo '<input type="checkbox" value="'. $cart_info["variation_id"]  .'" name="variant_order['.$cart_info["variation_id"].'" class="item_cart_checkbox">';
    echo '<img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">';
    echo '<div class="cart_item_description">';
    echo '<p class="item_cart_name">' . htmlspecialchars($cart_info["item_name"]) . ' (' . htmlspecialchars($cart_info["variation_name"]) . ')</p>';
    echo '<p class="item_cart_price">' . htmlspecialchars($cart_info["cart_price"]) . '</p>';
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

        <!-- <div class="seller_cart_wrapper">
            <div class="seller_cart_contents">
                <div class="seller_cart_name_container">
                    <input type="checkbox" class="cart_seller_checkbox">
                    <p class="seller_cart_name">Store 1</p>
                    <span class="delete-store"><i class="bi bi-trash"></i></span> 
                </div>
                <div class="seller_items_wrapper">
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 01</p>
                            <p class="item_cart_price">₱20</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash"></i>
                                <p class="cart_item_qty">1</p>
                                <i class="bi bi-plus"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 02</p>
                            <p class="item_cart_price">₱50</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">3</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
<!--         
        <div class="seller_cart_wrapper">
            <div class="seller_cart_contents">
                <div class="seller_cart_name_container">
                    <input type="checkbox" class="cart_seller_checkbox">
                    <p class="seller_cart_name">Store 2</p>
                    <span class="delete-store"><i class="bi bi-trash"></i></span> 
                </div>
                <div class="seller_items_wrapper">
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 01</p>
                            <p class="item_cart_price">₱20</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">1</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                    <div class="seller_item">
                        <input type="checkbox" class="item_cart_checkbox">
                        <img src="../assets/tmp.png" alt="Item Image" class="item_cart_img">
                        <div class="cart_item_description">
                            <p class="item_cart_name">Item 02</p>
                            <p class="item_cart_price">₱50</p>
                        </div>
                        <div class="item_counter_wrapper">
                            <div class="item_counter">
                                <i class="bi bi-dash" onclick="changeQuantity(event, -1)"></i>
                                <p class="cart_item_qty">3</p>
                                <i class="bi bi-plus" onclick="changeQuantity(event, 1)"></i>
                            </div>
                            <span class="delete-item"><i class="bi bi-trash"></i></span> 
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

    <script src="../js/cart.js"></script>
</body>
</html>
