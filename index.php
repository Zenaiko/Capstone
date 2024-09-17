<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 
    require_once('utilities/initialize.php'); 
    header("location: user_page/seller_product_add.php") ;
    session_start();
    $_SESSION['user'] = 'visitor';
    ?>
        
</body>
</html>