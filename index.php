<?php 
include_once("session.php");

?>

<!DOCTYPE html>
<html lan = "en-US">
    <head>
        <title>Restaurant Manager</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style_main.css">
        <script src="javascript/script.js"></script>
    </head>
    <body>
        <?php
            if (isset($_SESSION["user"])) { // IF LOGGED IN
                echo "<p id = 'Welcome'>👋 How you doing, today, " .$_SESSION["user"] . "? 👋</p>";
            }

?>

        <header>
        <div id="SearchBar">
                <form method = "post">
                    <input type="search" id="search" name="search" placeholder="Find your perfect restaurant by name, city, dish or average score...">
                    <button type = "submit-search" name = "submit-search">🔍</button>

                    <?php 
                        if (isset($_SESSION["user"])) { // IF LOGGED IN
                            echo "<a href='profile.php'>Profile</a>";
                            echo "<a href='includes/logout.inc.php'>Log out</a>";
                            echo "<a href = 'includes/create_restaurant_verify.inc.php'>Create my Restaurant</a>";
                            $checkingAux = $_SESSION["userid"]."user";
                        
                            if ($_SESSION[$checkingAux]["hasRestaurants"]){
                                $id = $_SESSION['userid'];
                                echo "<a href = 'includes/my_restaurants.inc.php?i=$id'>Manage my Restaurants</a>";
                            }
                        }
                        else {    // IF NOT LOGGED IN
                            echo "<a href='signup.php'>Register</a>"; 
                            echo "<a href='login.php'>Login</a>";
                            echo "<a href = 'includes/create_restaurant_verify.inc.php'>Create my Restaurant</a>";
                        }
                        
                        
                    ?>
                </form>
                    <div id = "searchResults">

    </div>  
    <?php 
    if (isset($_GET["error"]) || isset($_GET["r"])) {
        if ($_GET["r"] == "r") {
            foreach ($_SESSION["search"] as $row => $restaurant) { // FOR EVERY RESULT FOUND
                $string = "restaurant.php?id=".$restaurant['id'];
                echo "<h3 id = 'restaurantName'> <a href = $string> 👨‍🍳 " . $restaurant['Rname'] . " 👨‍🍳 </h3> </a>";
                echo "<h4 id = 'restaurantCity'> 🏠" . $restaurant['city'] . "🏠 </h4>"; // DISPLAY CITY OF RESTAURANT
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
                echo "<p id = 'restaurantAvg'> ⭐" . number_format((float)$restaurant['avgScore'], 2, '.', ''). "⭐ </p>"; 
                
                $stringthree = "restaurant".$restaurant['id']."favorite";
                if ($_SESSION[$stringthree] == true) {
                    echo "<p id = restaurantFavorite> ❤️ Is a favorite! ❤️ </p>"; 
                }
                $stringfour = "restaurant".$restaurant['id']."numberOfReviews";
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
        else if ($_GET["r"] == "f") {
            echo "<h3> No results found! </h3>";
        }
    }
    ?>
            </div>
            
        </header>
        <section id="restaurants">
            <header>
                <h1>Restaurants near you</h1>
            </header>
            <div id = "map">
                <iframe id = "google_map" 
                width = "425" 
                height = "350"
                frameborder = "0"
                scrolling ="no"
                marginheight= "0"
                marginwidth = "0"
                src = "https://maps.google.com?output=embed"
                ></iframe>
            </div>
            <a href = '#' id = "get_location">Show Current Location</a>
            <script>
                var c = function(pos) {
                    var lat = pos.coords.latitude,
                    long = pos.coords.longitude,
                    coords = lat + ', ' + long;
                document.getElementById('google_map').setAttribute('src', 'https://maps.google.com/?q='+ coords + '&z=60&output=embed')
                }
                document.getElementById('get_location').onclick = function() {
                    navigator.geolocation.getCurrentPosition(c);
                    return false;
                }
                var e = function(error) {
                    if (error.code==1) {
                        alert('Não foi possível obter a localização');
                    }
                }

            </script>
            <script>
                var x = document.getElementById("demo");
                function getLocation() {
                  if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                  } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                  }
                }
                
                function showPosition(position) {
                  x.innerHTML = "Latitude: " + position.coords.latitude +
                  "<br>Longitude: " + position.coords.longitude;
                }
            </script>
                        

        </section>
        <nav id="categorias">
            <h1>For you</h1>
            <ul>
            <li><a href="includes/categoria.inc.php?id=1">Sushi</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=2">Burgers</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=3">Pizza</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=4">Soups</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=5">Barbecue</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=6">Healthy</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=7">Vegan</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=8">Indian</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=9">Thai</a>
                </li>
                <li><a href="includes/categoria.inc.php?id=10">Chinese</a>
                </li>
            </ul>
            </nav>
            <?php require_once("footer.php") ?>
    </body>
</html>

