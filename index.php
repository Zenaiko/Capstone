<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>
    <?php 
    require_once('utilities/initialize.php'); 
    session_start();
    $_SESSION['user'] = 'visitor';
    header("location: user_page/home.php") ;
    ?>

</body>
</html>