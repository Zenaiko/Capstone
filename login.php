<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Login</title>
    <?php
    (session_status() === PHP_SESSION_NONE)?session_start():null;?>
</head>
<body>
    <?php require_once("utilities/initialize.php");?>
    <section class="main_section">
        <div class="main_container">
        <?php require_once('header.php') ?>
        <div class="main_contents_wrapper">
            <div class="main_contents_container">
                <div class="main_content">

                    <form id="login_form" action="db_api/db_cus_login.php" method="post">
                        <div id="login_container">
                            <div id="login_field">
                                <input type="text" name="cus_log_user" autocomplete="off" required id="username_field" placeholder="Username/Email">
                                <div>
                                    <input type="password" name="cus_log_pass" required id="pass_field" placeholder="Password">
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

<?php
if (isset($_SESSION['form_success'])) {
    if ($_SESSION['form_success'] === "success") {
        echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Thank you for joining Cab Mart',
            text: 'Account has been successfully created',
        });
        </script>";
    } elseif ($_SESSION['form_success'] === "error") {
        echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'An error has occured when creating you account',
            text: 'Please try again',
        </script>";
    }

    // Unset the session variable after displaying it
    unset($_SESSION['form_success']);
}
?>

</body>
</html>
