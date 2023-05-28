<?php 
include_once("session.php");
include_once("backtoindex.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reviews</title>
      <link href="css/style_favorites.css" rel="stylesheet">
    </head>
    <body>  
        <h1 id = "FavoriteHeader">Reviews</h1>

        <container id = "FavoriteRestaurants">
            <h2 id = "YourFavoriteRestaurants">Your reviewed Restaurants</h2>
            <?php
                for ($a = 1; $a <= $_SESSION["userNumOfRestReviews"]; $a++) {
                    $rId = $_SESSION[$a."RreviewRid"];
                    $name = $_SESSION["restaurant".$rId]["Rname"];
                    $city = $_SESSION["restaurant".$rId]["city"];
                    $content = $_SESSION[$a."Rreviewcontent"];
                    $score = $_SESSION[$a."Rreviewscore"];
                    $linkRestaurant = "restaurant.php?id=$a";
                    echo "<h3 id = 'restaurantName'> <a href = $linkRestaurant> 👨‍🍳 " . $name . " 👨‍🍳 </h3> </a>";
                    echo "<h4 id = 'restaurantCity'> 🏠" . $city . "🏠 </h4>";
                    echo "<p id = 'restaurantAvg'> ⭐" . $score. "⭐ </p>"; 
                    if (!empty($content)) {
                        echo "<h4 id = restaurantCity> 📝" . $content . "📝 </h4>";
                    }
                }
            ?> 


        </container>

        <container id = "FavoriteRestaurants">
            <h2 id = "YourFavoriteRestaurants">Your reviewed Dishes</h2>
            <?php
                for ($a = 1; $a <= $_SESSION["userNumOfDishReviews"]; $a++) {
                    $restaurantId = $_SESSION[$a."DreviewRestId"];
                    $dId = $_SESSION[$a."Dreviewid"];
                    $name = $_SESSION[$restaurantId."dish".$dId]["nome"];
                    $content = $_SESSION[$a."Dreviewcontent"];
                    $score = $_SESSION[$a."Dreviewscore"];
                    $linkDish = "dish.php?id=$dId&r=$restaurantId";
                    echo "<h3 id = 'restaurantName'> <a href = $linkDish> 🍽️ " . $name . " 🍽️ </h3> </a>";
                    echo "<p id = 'restaurantAvg'> ⭐" . $score. "⭐ </p>"; 
                    if (!empty($content)) {
                        echo "<h4 id = restaurantCity> 📝" . $content . "📝 </h4>";
                    }
                }
            ?> 


        </container>
    </body>