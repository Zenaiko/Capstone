<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/item_interaction.css">

<?php require_once('../utilities/initialize.php');?>

<form action="cus_checkout.php" id="variant_order_data" method="post">
    <div id="item_interaction_wrapper">
        <div id="item_interaction_container">
           <div id="item_interaction_share"><i class="bi bi-share"></i><p>Share</p></div>
           <div id="item_interaction_message"><i class="bi bi-chat-dots"></i><p>Message</p></div>
           <div id="item_interaction_cart" class="interact_buttons" data-bs-toggle="offcanvas" data-bs-target="#order" aria-controls="offcanvasBottom"><i class="bi bi-cart2"></i><p>Add to cart</p></div>
           <div id="item_interaction_order" class="interact_buttons" data-bs-toggle="offcanvas" data-bs-target="#order" aria-controls="offcanvasBottom"><p>Order Now</p></div>
        </div>
    </div>
    
    
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="order" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <div class="order_information">
                <img id="img_feature" src="../assets/tmp.png" alt="">
                <div class="price_stock">
                    <p class="item_price" id="v_price"></p>
                    <p id="variant_stock"> </p>
                </div>
            </div>
            <button type="button" id="close_order" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr>
        <div class="offcanvas-body">
            <div id="item_contents_container">
                <div id="item_contents">
    
                    <?php foreach($item_info->get_variant_info() as $variant){?>
    
                        <div class="variant" id="<?=$variant['variation_id']??null?>">
                            <p class="variant_name"><?=$variant['variation_name']??null?></p>
                        </div>
    
                    <?php } ?>
    
                </div>
            </div>
        </div>

        <input type="text" name="shop_order" id="shop_order" value="<?=$seller_info->get_seller_id()?>" hidden readonly>
        <input type="text" name="item_order" id="item_order" value="<?=$_GET["item"]?>" hidden readonly>
        <input type="text" name="variant_order[]" id="variant_order" hidden >
        <input type="text" id="order_qty" value="1" hidden>
    
        <div class="offcanvas-footer">
            <input type="submit" readonly name="interact_button" id="interact_button" value="">
        </div>
    </div>
</form>

<script src="../js/item_interaction.js"></script>
