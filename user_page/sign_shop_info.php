<meta name="viewport" content="width=device-width, initial-scale=1.0">
<form action="../db_api/db_seller_sign.php" id="shop_information_form" method="post" enctype="multipart/form-data">
    <p id="shop_info_title" class="m-0 text-uppercase">Shop Information</p>
    <div id="shop_img_sign_wrapper">
        <div id="shop_img_sign_container">
            <p>Shop Image</p>
            <img src="https://via.placeholder.com/125x125" alt="" id="sign_img_preview">
            <input type="file" name="sign_upload_shop_image" id="sign_upload_shop_image" value="Upload Image">
        </div>
    </div>

    <div id="seller_sign_field">
        <label for="sign_shop_name">Shop Name</label><input type="text" name="sign_shop_name" id="sign_shop_name">
        <p id="address_title" class="m-1 text-uppercase">Address</p>
        <button id="seller_sign_loc_button"> Use Current Location <i class="bi bi-geo-alt"></i></button>
        <label for="sign_shop_street">Street</label><input type="text" name="sign_shop_street" id="sign_shop_street">
        <label for="sign_shop_barngay">Barangay</label><input type="text" name="sign_shop_barngay" id="sign_shop_barngay">
        <label for="sign_shop_house">House/unit number</label><input type="text" name="sign_shop_number" id="sign_shop_number">
        <div id="shop_sell_food_container"><label for="shop_sell_food">Shop will sell food</label><input type="checkbox" name="shop_sell_food" id="shop_sell_food"></div>
    </div>

    <input type="submit" value="Next" name="submit_shop_info" id="sign_bs_info_next">
</form>