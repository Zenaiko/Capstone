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
        <?php require_once("arrow_header.php");
        session_start();
        $_SESSION['visitor_sign_num'] = $_POST['opt_phone'];?>

<form action="sign_up.php" id="otp_form">
    <div id="otp_form_container">
        <div id="otp_form_contents">
            <p class="h3 fw-bold text-center">Enter Your OTP</p>
            <div id="otp_field_wrapper">
                <div id="otp_field">
                    <input type="number" name="" class="otp_input" maxlength="1">
                    <input type="number" name="" class="otp_input" maxlength="1">
                    <input type="number" name="" class="otp_input" maxlength="1">
                    <input type="number" name="" class="otp_input" maxlength="1">
                </div>
            </div>
            <p id="resend_otp" class="text-center"> Resend Code in <span id="otp_timer"> 30 seconds </span></p>
            <input type="submit" class="submit_button" value="Verify">
        </div>
    </div>
</form>
</div>
</section>

</body>
</html>
