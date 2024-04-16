<?php 
    require_once("navbar.php");
?>

<?php 
require_once("../query/conn.php");

$topMarketQry = "SELECT * FROM tblMarket ORDER BY marketRate DESC LIMIT 10";
$getTopMarket = $conn->execute_query($topMarketQry); 

$trendingItemQry = "SELECT * FROM tblItem INNER JOIN tblMarket ON tblMarket.marketID = tblItem.marketID 
ORDER BY  itemRating DESC LIMIT 10" ;
$getTrendingItem = $conn->execute_query($trendingItemQry);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/market.css">
</head>
<body>
    <section id="marketSelector">
        <figure>
            <img src="/pages/images/rawGoods.jpg" alt="">
        
            <figcaption>Raw Goods
                <p>Vegetables, Fruits, Raw Meat & More</p>
            </figcaption>
   

        </figure>

        <figure>
            <img src="/pages/images/processedFoods.jpg" alt="">
            <figcaption>Processed Foods
                <p>Carinderia, Restaurants, Milktea & More</p>
            </figcaption>
        </figure>
    </section>

    <div id="containerMarket">
    <section id="topMarket">
        <p>Top Stores</p>
    <ul class="sorter">


<?php  
    while($topMarket = $getTopMarket-> fetch_assoc()){

    echo ' 
    <li>
        <figure>
            <img src="images/' . $topMarket['marketImg'] . '" alt="">
            <figcaption>' . $topMarket['marketName'] . '</figcaption>
        </figure>
    </li>'
    ;

        
    }
?>

        </ul>
    </section>



    <section id="trending">
        <p>Trending</p>
        <div id="trendingMarketList">
        <ul class="sorter">

        <?php 

        while($trendingItem = $getTrendingItem->fetch_assoc()){
        echo '
        <li>
        <figure>
        <img src="images/' .$trendingItem['itemImage']. '" alt="">
        <figcaption>
            <ul>
                <li>' .$trendingItem['marketName'] . '</li>
                <li>' . $trendingItem['itemRating']. '</li>
                <li>'.$trendingItem['price'].'</li>
            </ul>
            </figcaption>
        </figure>
        <li>';
        }

        ?>

     
        </ul>
        </div>
    </section>
    </div>
</body>
</html>