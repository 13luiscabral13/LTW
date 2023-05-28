<?php 
include_once("session.php");
include_once("backtoindex.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Favorites</title>
      <link href="css/style_favorites.css" rel="stylesheet">
    </head>
    <body>  
        <h1 id = "FavoriteHeader">Favorites</h1>

        <container id = "FavoriteRestaurants">
        
            <?php
            $checkerR = true;
                for ($a = 1; $a <= $_SESSION["numberofrestaurants"]; $a++) {
                    
                    if ($_SESSION["restaurant".$a."favorite"]) {
                        if ($checkerR) {
                            echo '<h2 id = "YourFavoriteRestaurants">Your favorite restaurants</h2>';
                            $checkerR = false;
                        }
                        $link = "restaurant.php?id=".$a;
                        $name = $_SESSION["restaurant".$a]["Rname"];
                        $city = $_SESSION["restaurant".$a]["city"];
                        $avgScore = $_SESSION["restaurant".$a]["avgScore"];
                        $categoria = $_SESSION["restaurant".$a]["categoria"];
                        echo "<h3 id = 'restaurantName'> <a href = $link> 👨‍🍳 " . $name . " 👨‍🍳 </h3> </a>";
                        echo "<h4 id = 'restaurantCity'> 🏠" . $city . "🏠 </h4>"; // DISPLAY CITY OF RESTAURANT
                switch ($categoria) {
                    case 'barbecue':
                        $icon = '♨️';
                        break;
                    case 'chinese':
                        $icon = '🍜';
                        break;
                    case 'hamburger':
                        $icon = '🍔';
                        break;  
                    case 'healthy':
                        $icon = '🥗';
                        break;
                    case 'indian':
                        $icon = '🍛';
                        break;
                    case 'pizza':
                        $icon = '🍕';
                        break;
                    case 'soup':
                        $icon = '🥣';
                        break;
                    case 'sushi':
                        $icon = '🍣';
                        break;
                    case 'thai': 
                        $icon = '🍱';
                        break;
                    case 'vegan':
                        $icon = '🥬';
                        break;
                }
                    echo "<p id = 'restaurantCategoria'> ".$icon . $categoria .$icon ."</p>"; // DISPLAY CATEGORIA OF RESTAURANT
                    echo "<p id = 'restaurantAvg'> ⭐" . number_format((float)$avgScore, 2, '.', ''). "⭐ </p>"; 
                    } 
                }
            ?> 
        </container>

        <container id = "FavoriteRestaurants">
            <?php
            $checkerD = true; 
                for ($a = 1; $a <= $_SESSION["allDishes"]; $a++) {
                    for ($b = 1; $b <= $_SESSION["numberofrestaurants"]; $b++) {
                        if ($_SESSION[$b."dish".$a."favorite"]) {
                            if ($checkerD) {
                                echo '<h2 id = "YourFavoriteRestaurants">Your favorite dishes</h2>';
                                $checkerD = false;
                            }
                        $checkerD = true;
                        $link = "dish.php?id=".$a."&r=".$b;
                        $nameD = $_SESSION[$b."dish".$a]['nome'];
                        $categoriaD = $_SESSION[$b."dish".$a]['categoria'];
                        $priceD = $_SESSION[$b."dish".$a]['preco'];
                        $avgScoreD = $_SESSION[$b."dish".$a]['avgScore'];
                        echo "<h3 id = 'restaurantName'> <a href = $link> 🍽️ " . $nameD . "🍽️  </h3> </a>";

                switch ($categoriaD) {
                    case 'barbecue':
                        $icon = '♨️';
                        break;
                    case 'chinese':
                        $icon = '🍜';
                        break;
                    case 'hamburger':
                        $icon = '🍔';
                        break;  
                    case 'healthy':
                        $icon = '🥗';
                        break;
                    case 'indian':
                        $icon = '🍛';
                        break;
                    case 'pizza':
                        $icon = '🍕';
                        break;
                    case 'soup':
                        $icon = '🥣';
                        break;
                    case 'sushi':
                        $icon = '🍣';
                        break;
                    case 'thai': 
                        $icon = '🍱';
                        break;
                    case 'vegan':
                        $icon = '🥬';
                        break;
                }

                    echo "<p id = 'restaurantCategoria'> ".$icon . $categoriaD .$icon ."</p>"; // DISPLAY CATEGORIA OF RESTAURANT
                    echo "<p id = 'restaurantAvg'> ⭐" .  number_format((float)$avgScoreD, 2, '.', ''). "⭐ </p>"; 
                    $linkR = "restaurant.php?id=".$b;
                    echo "<p id = 'restaurantName'> <a href = $linkR>" .$nameR. " </a></p>";
                        }
                    } 
                }

            ?>

    </body>