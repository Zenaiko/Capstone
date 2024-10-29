<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="main_section">
    <div class="main_container">
        <?php require_once("arrow_header.php")?>
        
        <div class="second_placeholder_container">
            <div class="second_placeholder_content">
                <!-- <form action="" id="number_for_otp_form" method="post"> -->
                    <div id="otp_number_container">
                        <div id="otp_number_contents">
                            <p class="h3 fw-bold text-center">Enter your phone number</p>
                            <form action="" id="visitor_sign_contact">
                                <input type="number" name="opt_phone" id="opt_phone" placeholder="Phone Number" maxlength="11">
                                <input type="submit" name="" id="otp_send_code" value="Send Code" class="submit_button">
                            </form>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
        
    </div>
</section>
    <script src="js/number_verifcation.js"></script>

</body>
</html>




