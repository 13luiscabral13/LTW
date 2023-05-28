<?php 
include_once("session.php");
include_once("backtoindex.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Restaurant</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    
    <body>
        <form action="<?php if ($_GET["e"] != 't') {
            echo 'includes/add_dish.inc.php?Ri='.$_GET["Ri"];
        } 
        else {
            echo 'includes/add_dish.inc.php?Ri='.$_GET["Ri"]."&e=t";
        }
        ?>" method="post">
            <div class="container">
                <?php 
                if ($_GET["e"] != 't') { ?>
                <h1>You gotta have some food, right?</h1>
                <p>Add your tasty dishes to your restaurant before finishing</p>
                <hr>
                <?php }
                else { ?>
                <h1><?php echo 'Add the dishes you wish to '.$_SESSION['restaurant'.$_GET["Ri"]]['Rname']; ?></h1>
                <?php 
                }
                if ($_SESSION[$_GET["Ri"]."dishes"]>0) {
                    for ($a = 1; $a <= $_SESSION["allDishes"]; $a++) {
                        if ($_SESSION[$_GET["Ri"]."dish"."$a"]) {
                        $ri = $_GET["Ri"];
                        echo "<h3 id = 'dishName'> 🍽️ " . $_SESSION[$_GET["Ri"]."dish".$a]['nome'] . " 🍽️ </h3> </a>";
                        echo "<h4 id = 'dishDescription'> 📜 ".$_SESSION[$_GET["Ri"]."dish".$a]['descricao'] ." 📜 </h4>";
                        echo "<h4 id = 'dishPrice'> 💸 ".$_SESSION[$_GET["Ri"]."dish".$a]['preco'] ." 💸 </h4>";
                        echo "<h4 id = 'dishEdit'><a href = 'edit_dish.php?id=$a&Ri=$ri' > ✏️ Edit Dish ✏️ </a></h4>"; 
                        if ($_GET["e"] == 't') {
                            $stringSend = "includes/delete_dish.inc.php?id=$a&Ri=$ri&e=t";
                        }
                        else {
                            $stringSend = "includes/delete_dish.inc.php?id=$a&Ri=$ri";
                        }
                        echo "<h4 id = 'dishPrice'><a href = $stringSend > 🚫 Delete Dish 🚫 </a></h4>"; 
                        }
                    }
                }
                ?>
                <button type = "submit" name = "create">Add a dish!</button>
                <?php
                if ($_SESSION[$_GET["Ri"]."dishes"] > 0) {
                echo '<button type = "submit" name= "leave">That\'s Enough Dishes...</button>';
                }
                ?>
            </div>
                
        <?php require_once("footer.php"); ?>
    </body>
</html>