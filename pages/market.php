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
</head>
<body>
    <section id="marketSelector">
        <figure>
            <img src="" alt="">
            <figcaption><a href="">Raw Goods</a></figcaption>
            <figcaption>Vegetables, Fruits, Raw Meat & More</figcaption>
        </figure>

        <figure>
            <img src="" alt="">
            <figcaption>Processed Foods</figcaption>
            <figcaption>Carinderia, Restaurants, Milktea & More</figcaption>
        </figure>
    </section>

    <section id="topMarket">
    <ul>
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


    <secion id="trending">
        <p>Trending</p>
        <div id="trendingMarketList">

        <?php 

        while($trendingItem = $getTrendingItem->fetch_assoc()){
        echo '
        <figure>
            <img src="images/' .$trendingItem['itemImage']. '" alt="">
            <figcaption>' .$trendingItem['marketName'] . '</figcaption>
            <figcaption>' . $trendingItem['itemRating']. '</figcaption>
            <figcaption>'.$trendingItem['price'].'</figcaption>
        </figure>'
        ;
        }

        ?>

        </div>
    </secion>
</body>
</html>