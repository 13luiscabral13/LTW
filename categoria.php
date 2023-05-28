<?php 
include_once("session.php");
require_once 'includes/functions.inc.php';
require_once 'includes/dbh.inc.php';
include_once("backtoindex.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php echo '<title>'.$_SESSION["thisCategoria"].'</title>' ?>
    <link href="css/style_favorites.css" rel="stylesheet">
</head>
<body>

    <section id="restaurantes">
    <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $string = 'categoria'.$id.'restaurants';
                if ($_SESSION['categoria'.$id.'hasrestaurants'] != false) {
                    echo '<h2 id = header> All our '. $_SESSION["thisCategoria"] .' restaurants';
                foreach($_SESSION[$string] as $row => $restaurant) {
                $stringtwo = "restaurant.php?id=".$restaurant['id'];
                echo "<h3 id = 'restaurantName'> <a href = $stringtwo> 👨‍🍳 " . $restaurant['Rname'] . " 👨‍🍳 </h3> </a>";
                echo "<h4 id = 'restaurantCity'> 🏠" . $restaurant['city'] . "🏠 </h4>"; // DISPLAY CITY OF RESTAURANT
                /*
                switch ($restaurant['categoria']) {
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
                echo "<p id = 'restaurantCategoria'> ".$icon . $restaurant['categoria'] .$icon ."</p>"; // DISPLAY CATEGORIA OF RESTAURANT
                NO NEED TO SHOW */ 
                echo "<p id = 'restaurantAvg'> ⭐" . number_format((float)$restaurant['avgScore'], 2, '.', ''). "⭐ </p>"; 
                $stringthree = "restaurant".$restaurant['id']."favorite";
                if ($_SESSION[$stringthree] == true) {
                    echo "<p id = restaurantFavorite> ❤️ Is a favorite! ❤️ </p>"; 
                }
                $stringfour = $restaurant['id']."numberOfReviews";
                if ($_SESSION[$stringfour] > 1) {
                    echo "<p id = restaurantFavorite> 📝 You've reviewed this restaurant ".$_SESSION[$stringfour]." times! 📝";
                }
                else if ($_SESSION[$stringfour] == 1) {
                    echo "<p id = restaurantFavorite> 📝 You've reviewed this restaurant ".$_SESSION[$stringfour]." time! 📝";
                }
                if ($_SESSION["restaurant".$restaurant['id']]["dono"] == $_SESSION["userid"]) {
                    echo "<p id = restaurantFavorite> 🔐 You own this restaurant! 🔐";
                }
                }
            }
        }

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stringa = 'categoria'.$id.'dishes';
                if ($_SESSION['categoria'.$id.'hasdishes'] != false) {
                echo '<h2 id = header> All our '. $_SESSION["thisCategoria"] .' dishes';
                
                foreach($_SESSION[$stringa] as $row => $dish) {
                $stringth = "dish.php?id=".$dish['id']."&r=".$dish['restaurantId'];
                echo "<h3 id = 'restaurantName'> <a href = $stringth> 🍽️ " . $dish['nome'] . " 🍽️ </h3> </a>";
                $rId = $dish['restaurantId'];
                $restaurantToShow = $_SESSION['restaurant'.$rId]['Rname'];
                $cityToShow = $_SESSION['restaurant'.$rId]['city'];
                echo "<h4 id = 'restaurantCity'> 💵" . $dish['preco'] . "💵 </h4>"; // DISPLAY CITY OF RESTAURANT
                echo "<p id = 'restaurantAvg'> ⭐" . number_format((float)$dish['avgScore'], 2, '.', ''). "⭐ </p>"; 
                $stringthree = $dish['restaurantId']."dish".$dish['id']."favorite";
                
                echo "<h5 id = 'restaurantNameDish'> <a href = 'restaurant.php?id=$rId'> " .  $restaurantToShow . " </a></h5>";
                echo "<h6 id = 'restaurantCityDish'> ".$cityToShow . "</h6>";
                if ($_SESSION[$stringthree] == true) {
                    echo "<p id = restaurantFavorite> ❤️ Is a favorite! ❤️ </p>"; 
                }
                }
            }
        }
        ?>

    </section>
    <section id="dishes">
        
    </section>
    <?php require_once("footer.php") ?>
</body>
</html>