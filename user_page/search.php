<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/item.css">
    <link rel="stylesheet" href="../css/search.css">
    <title>Document</title>
</head>
<body>

<?php require_once("../utilities/initialize.php");
            require_once("../utilities/nav.php");
            require_once("../db_api/db_get.php"); ?>

    <section id="search_section">
        <div id="search_contents">
            <?php 
            if(isset($_GET["category"])){
                $items = $get_db->get_category_item($_GET["category"]);
            }
            foreach($items as $item){
                include("../utilities/item_loop.php");
            }
            ?>
        </div>
    </section>

    <script src="../js/item_loop.js"></script>
</body>
</html>