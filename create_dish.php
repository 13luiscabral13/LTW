<?php 
include_once("session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Dish</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    <body>
        
        <div class="container">
                <h1>Create your dish</h1>
                <p>Please fill in this form to create your dish.</p>
                <hr>
                <form enctype="multipart/form-data" action="<?php 
                if ($_GET["e"] == 't') {
                echo 'includes/create_dish.inc.php?Ri='.$_GET["Ri"]."&e=t"; 
                }
                else {
                echo 'includes/create_dish.inc.php?Ri='.$_GET["Ri"]."&cr=y"; 
                }
                ?>" method = "post">
                <label for="name"><b>Name</b></label>
                <hr>
                <input type="text" placeholder="Enter name" name="name" id="name">
                
                <label for="description"><b>Dish Description</b></label>
                <hr>
                <input type="textarea" placeholder="Enter dish's description" name="description" id="description">
                <hr>
                <label for="price"><b>Price</b></label>
                <input type="price" placeholder="Enter price" name="price" id="price">
                <hr>
                <label for="categories"><b>Category</b></label>
                <select name="categories" id="categories">
                    <option selected value = "none" style="display:none"> -- select an option -- </option>
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
                <br><br>

                <label for="dishPic"><b>Upload dish picture</b></label>
                
                <input type="file" name="dishPic" required>


                <button type="submit" name = "submit" >Create Dish</button>
                </form>
                <hr>
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
                
            </div>
            



        
