<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign_up_seller.css">
    <title>Document</title>
</head>
<body>
    <?php require_once('../utilities/initialize.php'); 
    ?>

    <section id="seller_sign_up">
        <div id="seller_sign_up_wrapper">
            <div id="seller_sign_up_container">
                <?php
                if(isset($_GET['business_information'])){
                    include('sign_business_info.php');
                }else{
                    include('sign_shop_info.php'); }
                    ?>
            </div>
        </div>
    </section>
</body>
</html>