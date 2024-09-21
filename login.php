<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Login</title>
</head>
<body>
    
    <section class="main_section">
        <div class="main_container">
        <?php require_once('header.php') ?>
        <div class="main_contents_wrapper">
            <div class="main_contents_container">
                <div class="main_content">

                    <form id="login_form" action="db_api/db_cus_login.php" method="post">
                        <div id="login_container">
                            <div id="login_field">
                                <input type="text" name="cus_log_user" required id="" placeholder="Username/Email">
                                <div>
                                    <input type="password" name="cus_log_pass" required id="" placeholder="Password">
                                    <span id="show_password"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                            <div id="forget_container"><a href="" id="forget_pass">Forgot Password?</a></div>
                            <button id="login_submit" type="submit">Login</button>
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
