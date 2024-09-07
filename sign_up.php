<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Sign In</title>
</head>
<body>
<section class="main_section">
    <div class="main_container">
    <?php require_once('header.php')?>
        <div class="main_contents_wrapper">
            <div class="main_contents_container">
                <div class="main_content">
                    
                    <form action="">
                        <div id="sign_up_container">
                            <div id="sign_up_contents">
                                <p class="h5 text-uppercase">Sign Up</p>
                                <div id="sign_up_form">
                    
                                    <input type="text" id="fname_sign_up" placeholder="First Name">
                                    <input type="text" id="mname_sign_up" placeholder="Middle Name (*Optional*)">
                                    <input type="text" id="lname_sign_up" placeholder="Last Name">
                                    <input type="text" id="username_sign_up" placeholder="Username">
                                    <input type="email" id="email_sign_up" placeholder="Email Address">
                                    <div class="password_container"><input type="password" id="password_sign_up" placeholder="Password"></div>
                                    <div class="password_container"><input type="password" id="password_conform_sign_up" placeholder="Confirm Password"></div>
                    
                                </div>
                                                        
                                <div id="terms_conditions_container">
                                    <input id="terms_conditions_checkbox" type="checkbox">
                                    <label for="terms_conditions_checkbox">I agree with the <a href=""> terms & services</a></label>
                                </div>
                    
                                <input type="submit" name="" id="sign_up_submit" value="Sign In">
                            </div>
                        </div>
                    </form>
                </div>
                <?php require_once('footer.php') ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>