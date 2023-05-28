<?php 
include_once("session.php");
require_once 'includes/functions.inc.php';
require_once 'includes/dbh.inc.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/style_restaurantOwner.css" rel="stylesheet">
    <script src="javascript/restaurant.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>

        <section class="home" id="home">
            <div class="content">
                <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $name = $_SESSION[$string]['Rname'];
                    $bio = $_SESSION[$string]['slogan']; ?>     <a href = index.php><img src = "../images/logo.png" id = "backToIndex"></a> <br>
<?php
                    echo "<h3> " . $name . " </h3>";
                    echo "<p id = 'restaurantBio'>" . $bio . "</p>";
                } 
                ?>
            </div>
        </section>
    </header>
    <?php  
            if ($_SESSION["restaurant".$_GET["id"]]["dono"] != $_SESSION["userid"]) {
                if (!isset($_SESSION["user"])) {
                    $rId = $_GET['id'];
                    
                    $string = "restaurant".$rId;
                    $name = $_SESSION[$string]['Rname'];
                    echo '<a href="includes/restaurant_favorite.inc.php?id='.$rId.'&error=notLoggedIn" id = "markasfavorite"><img src="images/heartEmpty.png" alt=""></a>';
                }
                else {
                    $rId = $_GET['id'];
                    $string = "restaurant".$rId."favorite";
                    if ($_SESSION[$string] != true)  {
                        echo '<a href="includes/restaurant_favorite.inc.php?id='.$rId.'&active=0" id = "markasfavorite"><img src="images/heartEmpty.png" alt=""></a>';
                    }
                    else {
                        echo '<a href="includes/restaurant_favorite.inc.php?id='.$rId.'&active=1" id = "markasfavorite"><img src="images/heartFull.png" alt=""></a>';
                    }
                }
            }
            ?>
    <section id="info">
        <ul>
            
            <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $categoria = $_SESSION[$string]['categoria'];
                    $icon;
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
                    echo '<li>  <a href="categoria.php">' .$icon. $categoria .$icon . '</a></li>';
                } 
                ?>
            
        </ul>

        <?php 
            if ($_SESSION["restaurant".$_GET["id"]]["dono"] == $_SESSION["userid"]) {
                $id = $_GET["id"];
                    ?>
        <h2 id = "Edit"><a href = <?php echo"edit_restaurant_general.php?id=".$id ?>>✏️ Edit your Restaurant ✏️</a></h2>
        <?php }
        ?>
        <h2 id = "AboutUs">About us</h2>
        <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $aboutus = $_SESSION[$string]['bio'];
                    echo "<p id = 'Bio'>" . $aboutus . "</p>";
                } 
                ?>
        
    </section>
    

    <hr>
    
    <section id="Address">
    <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $city = $_SESSION[$string]['city'];
                    echo '<p> 🏠' . $city .  '🏠 </p>';
                } 
                ?>
    </section>
     <section id="Address">
    <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $city = $_SESSION[$string]['morada'];
                    echo '<p id ="morada"> 📍' . $city .  '📍 </p>';
                } 
                ?>
    </section>

    <section id="Address">
    <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $numOfReviews = $_SESSION[$string]["numOfReviews"];
                    echo '<p> Number of reviews: ' . $numOfReviews .  '</p>';
                    
                } 
                ?>
    </section>

    <section id="Address">
    <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $avgScore = $_SESSION[$string]["avgScore"];
                    echo '<p> Score: ' . number_format((float)$avgScore, 2, '.', '') .  '</p>';
                }
                ?>
    </section>
    
    <hr>
<?php if ($_SESSION["restaurant".$_GET["id"]]["dono"] != $_SESSION["userid"]) {
    ?>
    <div class="container">
        <h1>Have you ever ordered from <?php $id = $_GET["id"];
                    $string = "restaurant".$id;
                    $name = $_SESSION[$string]['Rname'];
                    echo $name ?>? Give us your review! </h1> 
      <div class="post">
        <div class="text">Thanks for rating us!</div>
        <div class="edit">EDIT</div>
      </div>
      
      <form action=<?php echo "includes/restaurant_review.inc.php?id=".$_GET["id"] ?> method = "post">
      <div class="star-widget">
        <input type="radio" name="rate" id="rate-5" value = 5>
        <label for="rate-5" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-4" value = 4>
        <label for="rate-4" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-3" value = 3>
        <label for="rate-3" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-2" value = 2>
        <label for="rate-2" class="fas fa-star"></label>
        <input type="radio" name="rate" id="rate-1" value = 1>
        <label for="rate-1" class="fas fa-star"></label>
        <header></header>
          <div class="textarea">
            <textarea cols="30" placeholder="Describe your experience.. (optional)" name = "contentOfReview" id = "contentOfReview"></textarea>
          </div>
          <div class="btn">
            <button type="submit" name = "submit">Submit your review</button>
          </div>
          <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "notLoggedIn") {
                    session_start();
                    $_SESSION["lastPage"] = "restaurant.php?id=".$_GET['id'];
                    echo "<h2> You need to be logged in to submit a review! </h2>";
                    echo "<h2 id = 'signinh'> <a href='login.php' id = 'signin'>Login here</a> </h2>";
                }
            }
        }
        ?>

        </form>
      </div>
    </div>


    <section class="dishes" id="dishes">
        <h1 class="heading" id = "OurDishes"> our <span>dishes</span></h1>
        <?php 
        echo '<div class="box-container">';
            $rId = $_GET["id"];
            $checkerDish = false;
            $counter=0;
            for ($a = 1; $a <= $_SESSION["allDishes"]; $a++) {
                $string = $rId."dish".$a;
                $link = "dish.php?id=".$a."&r=".$rId;
                if ($_SESSION[$string]['set']) {
                    $checkerDish = true;
                    if ($counter==3) {
                        echo '</div>';
                        $counter = 0;
                        echo '<div class = "box-container">';
                    }


                    echo '<div class="box">';
                    echo '<span class="price">'.$_SESSION[$string]["preco"].'</span>';
                    echo '<img src="dishesPics/' . $_SESSION[$string]["id"] . '.jpg" alt="">';
                    echo '<h3><a href ='."$link".'>'.$_SESSION[$string]["nome"].'</a></h3>';

                    
                    if ($_SESSION[$string]['avgScore'] > 0.2 && $_SESSION[$string]['avgScore'] < 0.7) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fa-regular fa-star-half-stroke"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 0.7 && $_SESSION[$string]['avgScore'] < 1.2) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 1.2 && $_SESSION[$string]['avgScore'] < 1.7) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fa-regular fa-star-half-stroke"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 1.7 && $_SESSION[$string]['avgScore'] < 2.2) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 2.2 && $_SESSION[$string]['avgScore'] < 2.7) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fa-regular fa-star-half-stroke"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 2.7 && $_SESSION[$string]['avgScore'] < 3.2) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 3.2 && $_SESSION[$string]['avgScore'] < 3.7) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fa-regular fa-star-half-stroke"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>'; 
                    }
                    else if ($_SESSION[$string]['avgScore'] > 3.7 && $_SESSION[$string]['avgScore'] < 4.2) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 4.2 && $_SESSION[$string]['avgScore'] < 4.7) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fa-regular fa-star-half-stroke"></i>';
                        echo '</div>';
                    }
                    else if ($_SESSION[$string]['avgScore'] > 4.7) {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '</div>';
                    }
                    else {
                        echo '<div class="stars" id = "starsD">';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '</div>';
                    }
                    if ($_SESSION["restaurant".$_GET["id"]]["dono"] != $_SESSION["userid"]) {
                        echo '<a class="btn" data-rId="'. $rId .'" data-dishId="' . $_SESSION[$string]['id']. '" data-name="' . $_SESSION[$string]["nome"] . '" id = "orderNow_' . $_SESSION[$string]["id"] . '" onclick="addToCart(' . "orderNow_" . $_SESSION[$string]["id"] . ')" >order now</a>';
                    }
                echo'</div>';
                $counter++;
                }
            }

            if ($checkerDish == false) {
                echo '<p> This restaurant does not have any dishes, yet... </p>';
            }
            echo '</div>';
            
    ?>
    
    <section class = "review" id="review">
            <h1 class="heading" id = "OurCustomersReviews"> Our costumers <span> reviews</span></h1>
            <?php 
            echo '<div class="box-container">';
            $rId = $_GET["id"];
            $checkerRev = false;
            $counter=0;
            for ($a = 1; $a <= $_SESSION["allRestReviews"]; $a++) {
                $string = $rId."review".$a;
                if ($_SESSION[$string]['exists']) {
                    $checkerRev = true;
                    if ($counter==3) {
                        echo '</div>';
                        $counter = 0;
                        echo '<div class = "box-container">';
                    }
                    echo '<div class="box">';
                    echo '<img src="images/burger.jpg" alt="">';
                    echo '<h3>'.$_SESSION[$string]['user'].'</h3>';
                    echo '<div class="stars" id = "starsR">';
                        switch ($_SESSION[$string]["score"]) {
                            case 1:
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                break;
                            case 2:
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                break;
                            case 3:
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                break;

                            case 4:
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="far fa-star"></i>';
                                break;

                            case 5:
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                echo '<i class="fas fa-star"></i>';
                                break;
                        }
                    echo '</div>';
                    echo '<p>'.$_SESSION[$string]["content"].'</a>';
                    if ($_SESSION["restaurant".$_GET["id"]]["dono"] == $_SESSION["userid"]) {
                        if (!$_SESSION[$rId."review".$a."responded"]) {
                        $id = $_GET["id"];
                        $linkToRespond = "includes/respondToReviewRest.inc.php?id=$a&Ri=$id";
                        ?>
                        <form action=<?php echo $linkToRespond; ?> method = "post">
                            <div class="textarea">
                                <textarea cols="30" placeholder="Respond to this review" name = "contentOfResponse" id = "contentOfResponse"></textarea>
                            </div>
                                <div class="btn">
                                    <button type="submit" name = "submit">Submit your response</button>
                                </div>
                        </form>
                    <?php
                        }
                        }
                        if ($_SESSION[$rId."review".$a."responded"]) {
                        echo '<div>';
                    echo '<h4 id = "ownersresponse"> Owner\'s Response: </h4>';
                    echo '<h4 id = "response"> '.$_SESSION[$rId."review".$a."response1"]["conteudo"].'</h4>';
                    echo '</div>';   
                        }         
                        echo'</div>';
                $counter++;
                
                }
            }
            if ($checkerRev == false) {
                echo '<h2 id = "noreviews"> This restaurant does not have any reviews, yet... </h2>';
                
            }
            echo '</div>';
            
            ?>
    
    </section>

    <!-- Esconder esta secção dos users -->
    <section id="orders">

    </section>

    <section id="cart">
        <div class="cartButton" onclick="openCart();">
            Cart
        </div>
        <div id="cartContainer" class="cartContainer cartContainerClosed">
            
        </div>
    </section>
    <?php require_once("footer.php"); ?>
</body>
</html>