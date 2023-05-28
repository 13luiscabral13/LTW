<?php 
include_once("session.php");
include_once("backtoindex.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>dish</title>
    <link href="css/style_dish.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>
    <section class="home" id="home">
            <div class="content">
                <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $rid = $_GET["r"];
                    $string = $rid."dish".$id;
                    $name = $_SESSION[$string]['nome'];
                    echo "<h3> " . $name . " </h3>";
                }

                ?>
            </div>
        </section>
        <?php
            if ($_SESSION["restaurant".$_GET["r"]]["dono"] != $_SESSION["userid"]) { ?>
    </header>
    <?php 
                if (!isset($_SESSION["user"])) {
                    $DId = $_GET['id'];
                    $Rid = $_GET['r'];
                    $string = $Rid."dish".$DId;
                    $name = $_SESSION[$string]['nome'];
                    $stringtwo = "Mark ". $name . " as favorite!";
                    echo '<a href="includes/dish_favorite.inc.php?id='.$DId.'&error=notLoggedIn&r='.$Rid.'" id = "markasfavorite"><img src="images/heartEmpty.png" alt=""></a>';
                }
                else {
                    $DId = $_GET['id'];
                    $Rid = $_GET['r'];
                    $string = $Rid."dish".$DId."favorite";
                    if ($_SESSION[$string] != true)  {
                        echo '<a href="includes/dish_favorite.inc.php?id='.$DId.'&r='.$Rid.'&active=0" id = "markasfavorite"><img src="images/heartEmpty.png" alt=""></a>';
                    }
                    else {
                        echo '<a href="includes/dish_favorite.inc.php?id='.$DId.'&r='.$Rid.'&active=1" id = "markasfavorite"><img src="images/heartFull.png" alt=""></a>';
                    }
                }
            }
            ?>


    <hr>
                
    <section id = "">
    <h2 id = "categoriaH">Category: </h2>

            
<!-- Colocar algo que vá buscar as categorias do restaurante à database -->
<?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $rId = $_GET["r"];
        $string = $rId."dish".$id;
        $categoria = $_SESSION[$string]['categoria'];
        echo '<p id = "element"><a href="categoria.php">' . $categoria . '</a></p>';
    } 
    ?>
    </section>
    <section>
<h2 id = "descricao">Description: </h2>

<?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $rId = $_GET["r"];
        $string = $rId."dish".$id;
        $categoria = $_SESSION[$string]['descricao'];
        echo '<p id = "element">' . $categoria . '</a>';
    } 
    ?>
    </section>

    <section id="priceInfo">
    <h2 id = "prico">Price: </h2>

    <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $rid = $_GET["r"];
                    $string = $rid."dish".$id;
                    $city = $_SESSION[$string]['preco'];
                    echo '<p id = "element"> ' . $city . ' $ ' . '</p>';
                } 
                ?>
    </section>

    <section id="restInfo">
    <h2 id = "restaurant">Restaurant: </h2>
            <?php
                if (isset($_GET["r"])) {
                    $id = $_GET["r"];
                    $string = "restaurant".$id;
                    $link = "restaurant.php?id=".$id;
                    $name = $_SESSION[$string]['Rname'];
                    echo "<h3><p id = 'element'><a href ='$link'> " . $name . "</a></p></h3>";
                } 
                ?>
    </section>
<?php if ($_SESSION["restaurant".$_GET["r"]]["dono"] != $_SESSION["userid"]) { ?>
<div class="container">
        <h1>Have you ever tried <?php $id = $_GET["id"];
                    $rid = $_GET["r"];
                    $string = $rid."dish".$id;
                    $name = $_SESSION[$string]['nome'];
                    echo $name ?>? Give us your review! </h1> 
      <div class="post">
        <div class="text">Thanks for rating it!</div>
        <div class="edit">EDIT</div>
      </div>
      
      <form action=<?php echo "includes/dish_review.inc.php?id=".$_GET["id"]."&r=".$_GET["r"] ?> method = "post">
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
?>
        </form>
      </div>
        </div>
        <?php } ?>
    <section id="info">
        <ul>
            <!-- Colocar algo que vá buscar as categorias do dishe à database -->
            <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $string = "dish".$id;
                    $categoria = $_SESSION[$string]['categoria'];
                    echo '<li><a href="categoria.php">' . $categoria .  '</a></li>';
                } 
                ?>
            
        </ul>
        
    </section>

    <hr>
    
    
    
    <hr>

    <section class = "review" id="review">
            <h1 class="heading" id = "OurCustomersReviews"> our costumers <span> reviews</span></h1>
            <?php 
            echo '<div class="box-container">';
            $rId = $_GET["r"];
            $dId = $_GET["id"];
            $checkerRev = false;
            $counter=0;
            for ($a = 1; $a <= $_SESSION["allDishReviews"]; $a++) {
                $string = $rId."dishreview".$a;
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
                    if ($_SESSION["restaurant".$_GET["r"]]["dono"] == $_SESSION["userid"]) {
                        if (!$_SESSION[$rId."dishreview".$a."responded"]) {
                        $id = $_GET["id"];
                        $ri = $_GET["r"];
                        $linkToRespond = "includes/respondToReviewDish.inc.php?id=$a&r=$r&di=$id";
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
                    if ($_SESSION[$rId."dishreview".$a."responded"]) {
                    echo '<div>';
                    echo '<h4 id = "ownersresponse"> Owner\'s Response: </h4>';
                    echo '<h4 id = "response">'.$_SESSION[$rId."dishreview".$a."response1"]["conteudo"].'</h4>';
                    echo '</div>';
                    }
                }
                echo'</div>';
                $counter++;
                
                }
            }
            if ($checkerRev == false) {
                echo '<h2 id = "noreviews"> This dish does not have any reviews, yet... </h2>';
                
            }
            echo '</div>';
            
            ?>

    <!-- Esconder esta secção dos users -->
    <section id="dishPriceHistory">
        <?php
            $string = $rid."dish".$id;
            $name = $_SESSION[$string]['nome'];
    
            
            
            $dishId = $_GET["id"];
            $dados = array();
            array_push($dados, ['Time', 'Price']);
            for ($c = 1; $c < $_SESSION["dish".$dishId."totalNumberOfPrices"]; $c++) {
                $price = $_SESSION["dish".$dishId."price".$c];
                $price = intval($price);
                $try = $_SESSION["dish".$dishId."price".$c."time"];
                $arrayToPush = [$try, $price];
                array_push($dados, $arrayToPush);
            }
            if (count($dados) > 2) {
                echo '<h3> '.$name.' price history: </h3>';
            $dados = json_encode($dados);
        ?>
    <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $dados ?>);

        var options = {
          title: "Price history:",
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
<?php } ?>
    </section>
    <?php require_once("footer.php"); ?>
</body>
</html>