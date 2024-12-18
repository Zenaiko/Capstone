<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/sign_up_seller.css">
<form action="../db_api/db_seller_sign.php" method="post" id="shop_business_form" enctype="multipart/form-data">
    <p id="bs_info_title">Business Information</p>
    <div id="sign_tin"><label for="tin_input">Taxpayer Identification Number (TIN)</label><input type="text" name="tin" id="tin_input"></div>

    <div id="bs_inp_container">
        <div id="bs_inp_field">
            <div id="sign_bir">
                <p class="sign_bs_title">Bureau of Internal Revenue (BIR) form 2303</p>
                <img src="../assets/tmp.png" alt="" class="sign_bs_img" id="bir_img_prev">
                <input type="file" name="bir" accept=".jpeg, .jpg, .png" id="bir" class="sign_bs_file seller_sign_img">
            </div>
            <hr>
            <div id="sign_dti">
                <p class="sign_bs_title">Department of Trade and Industry (DTI) business registration</p>
                <img src="../assets/tmp.png" alt="" class="sign_bs_img" id="dti_img_prev">
                <input type="file" name="dti" accept=".jpeg, .jpg, .png" id="dti" class="sign_bs_file seller_sign_img">
            </div>
            <hr>
            <div id="sign_sec">
                <p class="sign_bs_title">Securities and Exchange Commission (sec) General information sheet</p>
                <img src="../assets/tmp.png" alt="" class="sign_bs_img" id="sec_img_prev">
                <input type="file" name="sec" accept=".jpeg, .jpg, .png" id="sec" class="sign_bs_file seller_sign_img">
            </div>
            <hr>
            <div id="sign_mayor_perm">
                <p class="sign_bs_title">Mayor’s Permit</p>
                <img src="../assets/tmp.png" alt="" class="sign_bs_img" id="mayor_perm_img_prev">
                <input type="file" name="mayor_perm" accept=".jpeg, .jpg, .png" id="mayor_perm" class="sign_bs_file seller_sign_img">
            </div>
            <?php 
            if (isset($_GET['food_seller'])){?>
            <hr>
            <div id="sign_fda">
                <p class="sign_bs_title">Food and Drug Administration (FDA) registration</p>
                <img src="../assets/tmp.png" alt="" class="sign_bs_img" id="fda_img_prev">
                <input type="file" name="fda" accept=".jpeg, .jpg, .png" id="fda" class="sign_bs_file seller_sign_img">
            </div>
            <?php } ?>
        </div>
    </div>

    <hr>

    <div id="sign_agreement_container">
        <input type="checkbox" name="terms" value="1" id="agreement_terms_conditions"><label for="agreement_terms_conditions">I have read and agreed to the <a href="" id="terms_and_conditions">terms and conditions</a></label>
    </div>

    <div id="bs_info_footer_buttons">
        <button id="bs_info_back">Back</button>
        <input type="submit" value="Submit" name="submit_seller_form" id="seller_sign_submit">
    </div>

</form>