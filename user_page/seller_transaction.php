<?php    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/transaction.css">
    <link rel="stylesheet" href="../css/seller_item_inventory.css">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once("../utilities/initialize.php");
        require_once("../utilities/seller_nav.php");
    ?>

    <header class="header">
        <nav class="selector">
            <ul class="scrollable-tabs">
                <li class="transac_tab tab" id="requesting">Requesting</li>
                <li class="transac_tab tab" id="processing">Processing</li>
                <li class="transac_tab tab" id="shipping">Shipping</li>
                <li class="transac_tab tab" id="failed_delivery">Failed Delivery</li>
                <li class="transac_tab tab" id="completed">Completed</li>
                <li class="transac_tab tab" id="canceled">Canceled</li>
                <li class="transac_tab tab" id="cancel_request">Cancel Request</li>
            </ul>
            <div class="tab-indicator"></div>
        </nav>
    </header>

    <section id="transaction_section">
        <div id="transaction_loader">
            
        </div>
    </section>

    <script src="../js/transaction.js"></script>
</body>
</html>