<?php 
include_once("session.php");
?>
    
<!DOCTYPE html>
<html lan = "en-US">
    <head>
        <title>Edit Dish</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    <body>
        <?php 
            $rid = $_GET["Ri"];
            $dishId = $_GET["id"];


?>
        <form action = <?php 
        if ($_GET["e"] == "t") {
            echo "includes/edit_dish.inc.php?id=".$dishId."&Ri=$rid&e=t"; 
        }
        else {
            echo "includes/edit_dish.inc.php?id=".$dishId."&Ri=$rid"; 
        }
        ?> enctype="multipart/form-data" method = "post">
            <div class="container">
                <h1>Edit your dish</h1>
                <p>Customize your dish</p>
                <hr>
                <br> <br> <br>
                <label for="name"><b>Name</b></label>
                <hr>
                <input type="text" placeholder="Enter name" name="name" id="name" value = "<?= $_SESSION[$rid."dish".$dishId]["nome"]  ?>">
                
                <label for="description"><b>Dish Description</b></label>
                <hr>
                <input type="textarea" placeholder="Enter dish's description" name="description" id="description" value = "<?= $_SESSION[$rid."dish".$dishId]["descricao"];  ?>" >
                <hr>
                <label for="price"><b>Price</b></label>
                <input type="price" placeholder="Enter price" name="price" id="price" value = "<?= $_SESSION[$rid."dish".$dishId]["preco"];  ?>">
                <hr>
                <label for="categories"><b>Category</b></label>
                <select name="categories" id="categories">
                    <option selected style = "display:none" value = "<?= $_SESSION[$rid."dish".$dishId]["categoria"]; ?>"> <?php echo $_SESSION[$rid."dish".$dishId]["categoria"]; ?></option>
                    <option value="Sushi" name = "category">Sushi</option>
                    <option value="Hamburger" name = "category">Hamburger</option>
                    <option value="Pizza" name = "category">Pizza</option>
                    <option value="Soup" name = "category">Soup</option>
                    <option value="Barbecue" name = "category">Barbecue</option>
                    <option value="Healthy" name = "category">Healthy</option>
                    <option value="Vegan" name = "category">Vegan</option>
                    <option value="Indian" name = "category">Indian</option>
                    <option value="Thai" name = "category">Thai</option>
                    <option value="Chinese" name = "category">Chinese</option>
                </select>
                <hr>

                <button type="submit" name = "submit" >Edit Your Dish</button>
                
            </div>
            <?php 
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p> Please fill in all spaces! </p>";
                }
                if ($_GET["error"] == "invalidPrice") {
                    echo "<p> Please input a number for the price! </p>";
                }
            }
?>
        </form>
        <?php require_once("footer.php") ?>
    </body>
