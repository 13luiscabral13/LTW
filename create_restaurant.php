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
        <form action="<?php echo 'includes/create_rest.inc.php?l='.$_GET["l"]; ?>" method = "post">
            <div class="container">
                <h1>Your Restaurant Profile</h1>
                <p>Please fill in this form to create a profile for your restaurant.</p>
                <hr>
                <?php
                if ($_GET["l"] == 0) {
                echo '<label for="email"><b>Email</b></label>';
                echo '<input type="text" placeholder="Enter email" name="email" id="email">';
                echo '<label for="psw"><b>Password</b></label>';
                echo '<input type="password" placeholder="Enter password" name="psw" id="psw">';
                }
                ?>
                <label for="name"><b>Name of Restaurant</b></label>
                <input type="text" placeholder="Enter the name of your restaurant" name="name" id="name">

                <label for="city"><b>City</b></label>
                <input type="text" placeholder="Enter the city" name="city" id="city">

                <label for="address"><b>Address</b></label>
                <input type="text" placeholder="Enter the location" name="address" id="address">

                <label for="description"><b>Slogan</b></label>
                <input type="text" placeholder="Enter your restaurant's slogan" name="slogan" id="slogan">

                <label for="description"><b>Description</b></label>
                <input type="text" placeholder="Enter description" name="description" id="description">

                <hr>

                <p>By creating a restaurant you agree to our <a href="termsandconditions.php">Terms & Privacy</a>.</p>

                <button type="submit" name="submit" >Create</button>
            </div>

        </form>
        
        <?php 
         if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p> Please fill in all spaces! </p>";
            }
        }
            require_once("footer.php"); ?>
    </body>
</html>