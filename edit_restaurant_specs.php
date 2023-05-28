<?php 
include_once("session.php");
?>
    
<!DOCTYPE html>
<html lan = "en-US">
    <head>
        <title>Edit Restaurant</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    <body>
        <form action = <?php echo "includes/edit_restaurant_specs.inc.php?id=".$_GET['id']; ?> enctype="multipart/form-data" method = "post">
            <div class="container">
                <h1>Edit your Restaurant</h1>
                <p>Customize your restaurant to best suit you!</p>
                <hr>
                <br> <br> <br>
                <label for="email"><b>Restaurant Email</b></label>
                <input type="text" name="email" id="email" value = "<?= $_SESSION['restaurant'.$_GET["id"]]['email']; ?>">

                <label for="rname"><b>Restaurant Name</b></label>
                <input type="text" name="rname" id="rname" value = "<?= $_SESSION['restaurant'.$_GET["id"]]['Rname']; ?>">

                <label for="city"><b>City</b></label>
                <input type="text" name="city" id="city" value = "<?= $_SESSION['restaurant'.$_GET["id"]]['city']; ?>">

                <label for="address"><b>Address</b></label>
                <input type="text" name="address" id="address" value = "<?= $_SESSION['restaurant'.$_GET["id"]]['morada']; ?>">

                <label for="bio"><b>Slogan</b></label>
                <input type="text" name="bio" id="bio" value = "<?= $_SESSION['restaurant'.$_GET["id"]]['slogan'];?>">

                <label for="description"><b>Description</b></label>
                <input type="text" placeholder="Enter description" name="description" id="description" value = "<?= $_SESSION['restaurant'.$_GET["id"]]['bio']; ?>" >

                <hr>

                <button type="submit" name = "submit" >Edit Your Restaurant</button>
                
            </div>
            <?php 
            
            // ERROR HANDLING

?>
        </form>
        <?php require_once("footer.php") ?>
    </body>
