<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/manage_address.css">
    <title>Add Address</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
    <?php require_once("../utilities/initialize.php");
        require_once("../db_api/db_get.php");
    ?>

    <section id="address_section">
        <div id="address_container">
            
            <?php if(!empty($get_db->get_address($_SESSION["cus_id"]))){
                foreach($get_db->get_address($_SESSION["cus_id"]) as $address){?>
                     <div class="address_container">
                        <div class="address_header">
                            <p><?=$address["pickup_name"]?></p>
                            <a id="<?=$address["customer_pickup_id"]?>">Edit</a>
                        </div>
                        <div class="address_contact">
                            <p><?=$address["recipient_name"]?></p>
                            <span class="adr_splitter"></span>
                            <p class="con_num"><?=$address["contact"]?></p>
                        </div>
                        <div class="adr_info"><p><i class="bi bi-geo-alt"></i><?=$address["full_addres"]?></p></div>
                        <p><?=($address["is_default"])?"Default":null ?></p>
                    </div>
                    <hr>
            <?php }}else{ 
                echo "No address provided";
            } ?>
        </div>
    </section>

    <footer id="adr_footer">
        <a href="add_address.php" id="add_address">Add Address</a>
    </footer>

</body>
</html>