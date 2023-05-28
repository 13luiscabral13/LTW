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
        <h1 id = "FavoriteHeader">My Restaurants</h1>

        <container id = "OwnedRestaurants">
            <?php 
            $id = $_SESSION["userid"];
                for ($a = 0; $a < $_SESSION[$id."ownedRestaurantNumber"]; $a++) {
                    $name = $_SESSION["ownedRestaurant".$a]["Rname"];
                    $city =  $_SESSION["ownedRestaurant".$a]["city"];
                    $helper = $_SESSION['ownedRestaurant'.$a]['id'];
                    $linkRestaurant = "restaurant.php?id=$helper";
                    echo "<h3 id = 'restaurantName'> <a href = $linkRestaurant> 👨‍🍳 " . $name . " 👨‍🍳 </h3> </a>";
                    switch ($_SESSION["ownedRestaurant".$a]["categoria"]) {
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
                    echo "<p id = 'restaurantCategoria'> ". $icon . $_SESSION["ownedRestaurant".$a]["categoria"] . $icon ."</p>"; // DISPLAY CATEGORIA OF RESTAURANT
                    echo "<p id = 'restaurantAvg'> ⭐" . number_format((float)$_SESSION["ownedRestaurant".$a]["avgScore"], 2, '.', ''). "⭐ </p>"; 
                    echo "<h4 id = 'restaurantCity'> 🏠" . $city . "🏠 </h4>";
                }



            ?>
        </container>
    </body>