<?php 
include_once("session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Restaurant</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    
    <body>
        <form action="<?php echo 'includes/create_rest_spec.inc.php?Ri='.$_GET["Ri"]; ?>" method="post">
            <div class="container">
                <h1>Just a few more steps...</h1>
                <p>Please fill in this form to add your restaurant's specifications.</p>
                <hr>

                <label for="categories">Choose the primary category of your restaurant:</label>
                    <select name="categories" id="categories">
                        <option selected value = "none" style="display:none"> -- select an option -- </option>
                        <option value="sushi" name = "category">Sushi</option>
                        <option value="hamburger" name = "category">Hamburger</option>
                        <option value="pizza" name = "category">Pizza</option>
                        <option value="soup" name = "category">Soup</option>
                        <option value="barbecue" name = "category">Barbecue</option>
                        <option value="healthy" name = "category">Healthy</option>
                        <option value="vegan" name = "category">Vegan</option>
                        <option value="indian" name = "category">Indian</option>
                        <option value="thai" name = "category">Thai</option>
                        <option value="chinese" name = "category">Chinese</option>
                    </select>   
                <h6>(Don't worry... You can still have your dishes from other categories!)</h6>
                <hr>

                <button type="submit" name="submit" >Advance</button>
            </div>

        </form>
        <?php 
         if (isset($_GET["error"])) {
            if ($_GET["error"] == "novalue") {
                echo "<p> Please select a valid choice! </p>";
            }
        }
        require_once("footer.php");
        
        ?>
    </body>
</html>