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
    <?php require_once('header.php'); ?>
        <div class="main_contents_wrapper">
            <div class="main_contents_container">
                <div class="main_content">
                    
                    <form action="db_api/db_sign_visitor.php" method="post">
                        <div id="sign_up_container">
                            <div id="sign_up_contents">
                                <p class="h5 text-uppercase">Sign Up</p>
                                <div id="sign_up_form">
                    
                                    <input type="text" name="fname_sign_up" id="fname_sign_up" placeholder="First Name" required>
                                    <input type="text" name="mname_sign_up" id="mname_sign_up" placeholder="Middle Name (*Optional*)">
                                    <input type="text" name="lname_sign_up" id="lname_sign_up" placeholder="Last Name" required>
                                    <input type="text" name="username_sign_up" id="username_sign_up" placeholder="Username" required>
                                    <input type="email" name="email_sign_up" id="email_sign_up" placeholder="Email Address" required>
                                    <div class="password_container"><input type="password" name="password_sign_up" id="password_sign_up" placeholder="Password" required> <i class="bi bi-eye"></i></div>
                                    <div class="password_container"><input type="password" name="password_conform_sign_up" id="password_conform_sign_up" placeholder="Confirm Password" required> <i class="bi bi-eye"></i></div>
                    
                                </div>
                                                        
                                <div id="terms_conditions_container">
                                    <input id="terms_conditions_radio" name="terms_conditions_radio" type="radio">
                                    <label for="terms_conditions_radio">I agree with the <a href=""> terms & services</a></label>
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

<script src="js/sign_up.js"></script>
</body>
</html>
