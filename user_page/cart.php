<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <title>Document</title>
</head>
<body>

    <?php require_once('../utilities/initialize.php'); require_once('../utilities/cart_nav.php') ?>

    <section id="cart_section">
        <div id="cart_contents">

            <div class="seller_cart_wrapper">
                <div class="seller_cart_contents">
                    <div class="seller_cart_name_container">
                        <input type="checkbox" name="" id="" class="cart_seller_checkbox">
                        <p class="seller_cart_name">Store 1</p>
                    </div>
                    <div class="seller_items_wrapper">
                        <div class="seller_item">
                            <input type="checkbox" name="" id="" class="item_cart_checkbox">
                            <img src="../assets/tmp.png" alt="" class="item_cart_img">
                            <div class="cart_item_description">
                                <p class="item_cart_name">Item 01</p>
                                <p class="item_cart_price item_price">₱20</p>
                            </div>
                            <div class="item_counter_wrapper">
                                <div class="item_counter">
                                    <i class="bi bi-dash"></i>
                                    <p class="cart_item_qty">1</p>
                                    <i class="bi bi-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="seller_item">
                            <input type="checkbox" name="" id="" class="item_cart_checkbox">
                            <img src="../assets/tmp.png" alt="" class="item_cart_img">
                            <div class="cart_item_description">
                                <p class="item_cart_name">Item 01</p>
                                <p class="item_cart_price item_price">₱20</p>
                            </div>
                            <div class="item_counter_wrapper">
                                <div class="item_counter">
                                    <i class="bi bi-dash"></i>
                                    <p class="cart_item_qty">3</p>
                                    <i class="bi bi-plus"></i>
                                </div>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>

            <hr class="splitter">

            <div class="seller_cart_wrapper">
                <div class="seller_cart_contents">
                    <div class="seller_cart_name_container">
                        <input type="checkbox" name="" id="" class="cart_seller_checkbox">
                        <p class="seller_cart_name">Store 1</p>
                    </div>
                    <div class="seller_items_wrapper">
                        <div class="seller_item">
                            <input type="checkbox" name="" id="" class="item_cart_checkbox">
                            <img src="../assets/tmp.png" alt="" class="item_cart_img">
                            <div class="cart_item_description">
                                <p class="item_cart_name">Item 01</p>
                                <p class="item_cart_price item_price">₱20</p>
                            </div>
                            <div class="item_counter_wrapper">
                                <div class="item_counter">
                                    <i class="bi bi-dash"></i>
                                    <p class="cart_item_qty">1</p>
                                    <i class="bi bi-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="seller_item">
                            <input type="checkbox" name="" id="" class="item_cart_checkbox">
                            <img src="../assets/tmp.png" alt="" class="item_cart_img">
                            <div class="cart_item_description">
                                <p class="item_cart_name">Item 01</p>
                                <p class="item_cart_price item_price">₱20</p>
                            </div>
                            <div class="item_counter_wrapper">
                                <div class="item_counter">
                                    <i class="bi bi-dash"></i>
                                    <p class="cart_item_qty">3</p>
                                    <i class="bi bi-plus"></i>
                                </div>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>

            </div>
        </div>
    </section>
</body>
</html>