<?php 
    require_once("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/newsFeed.css">
    <title>Document</title>
</head>
<body>
    <a type="text" placeholder="Post Something..."></a>

<section class="newsfeed">
    <div class="post">
        <div class="postAccount">
            <ul class="accountDisplay">
            <li> <a href=""><img class="profileIcon" src="/pages/images/Megumi2.png" alt=""> </a></li>

            <li><a href="">Account Name</a></li>

            <li><a href="">Edit</a></li>
            </ul>

            <div class="postStrcture">
                <figure>
                    <img src="" alt="" class="postImg">
                    <figcaption class="postCaption"></figcaption>
                </figure>

            <p class="postTime"></p>

            <div class="postBottom">
            <ul>
                <li><a href="">Comment</a></li>
                <li><a href="">Heart</a></li>
            </ul>

            <span>Slider</span>
            </div>

            </div>
        </div>
    </div>


</section>
</body>
</html>
