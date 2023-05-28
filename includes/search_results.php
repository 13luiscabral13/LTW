    <?php
        require_once 'dbh.inc.php';

    $q=$_GET["q"];

    $stmt = $db->prepare('SELECT * FROM restaurants');

    $stmt->execute();

    $items = $stmt->fetchAll();

    $hints = array();

    for ($j = 0; $j < count($items); $j++) {

        if (substr_compare($items[$j]["Rname"], $q, 0, strlen($q), true) == 0) {
            array_push($hints, $items[$j]);
        } 
        else if(substr_compare($items[$j]["city"], $q, 0, strlen($q), true) == 0){
            array_push($hints, $items[$j]);
        }
        else if($items[$j]["avgScore"] >= $q){
            array_push($hints, $items[$j]);
        }

    }

    $response = '';

    if (count($hints) != 0) {
        for ($i = 0; $i < min(count($hints), 25); $i++) {
            //$response .= '<a href="restaurant.php?id=' . $hints[$i]["id"] . '" class = "searchOption">' . $hints[$i]["Rname"] . "<br>" ." Morada: " . $hints[$i]["morada"] . "</a>" ;
            $string = "restaurant.php?id=".$hints[$i]['id'];
            $response .= "<h3 id = 'restaurantName'> <a href = $string> 👨‍🍳" . $hints[$i]['Rname'] . "👨‍🍳 </h3> </a>";
            $response .= "<h4 id = 'restaurantCity'> 🏠" . $hints[$i]['city'] . "🏠 </h4>"; // DISPLAY CITY OF RESTAURANT
            switch ($hints[$i]['categoria']) {
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
            $response .= "<p id = 'restaurantCategoria'> ".$icon . $hints[$i]['categoria'] .$icon ."</p>"; // DISPLAY CATEGORIA OF RESTAURANT
            $response .= "<p id = 'restaurantAvg'> ⭐" . number_format((float)$hints[$i]['avgScore'], 2, '.', ''). "⭐ </p>"; 
            
            $stringthree = "restaurant".$hints[$i]['id']."favorite";
            if ($_SESSION[$stringthree] == true) {
                $response .= "<p id = restaurantFavorite> ❤️ Is a favorite! ❤️ </p>"; 
            }
            $stringfour = "restaurant".$hints[$i]['id']."numberOfReviews";
            if ($_SESSION[$stringfour] > 1) {
                $response .= "<p id = restaurantFavorite> 📝 You've reviewed this restaurant ".$_SESSION[$stringfour]." times! 📝";
            }
            else if ($_SESSION[$stringfour] == 1) {
                $response .= "<p id = restaurantFavorite> 📝 You've reviewed this restaurant ".$_SESSION[$stringfour]." time! 📝";
            }
        
        }
    } else {
        $response = 'No results';
    }
    //output the response
    echo $response;

    ?>