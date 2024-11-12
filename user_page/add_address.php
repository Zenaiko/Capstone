<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_address.css">
    <title>Add Address</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
    <?php require_once("../utilities/initialize.php") ?>

<form action="../db_api/db_address.php" method="post">
    <section id="add_adr_section">
        <div id="add_adr_container">
                <div class="adr_field"><label for="">Address Name</label><input name="adr_name" type="text"></div>
                <div class="adr_field"><label for="">Recipient Name</label><input name="recepient_name" type="text"></div>
                <div class="adr_field"><label for="">Contact</label><input name="contact" type="text"></div>

                <p>Address</p>
                <button>Use Current Location<i class="bi bi-geo-alt"></i></button>

                <div class="adr_field"><label for="">Street</label><input name="street" type="text"></div>
                <div class="adr_field"><label for="">Barangay</label><input name="brngy" type="text"></div>
                <div class="adr_field"><label for="">House/Unit Number</label><input name="hosue_num" type="text"></div>
                
                <div id="default_adr_div"><input type="checkbox" name="default" id="default"><label for="">Set as Default Address</label></div>


        </div>
    </section>

    <div id="manage_adress_container">
        <button id="manage_adress">Save</button>
    </div>

</form>
  
</body>
</html>