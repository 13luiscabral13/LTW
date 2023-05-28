<?php 
include_once("session.php");
include_once("backtoindex.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Restaurant</title>
        <meta charset="UTF-8">
        <link href= "css/style_verify.css" rel="stylesheet">
    </head>
    <body>
        <h2>What do you want to change in your restaurant?</h2>
        <div>
            <a href= <?php echo"edit_restaurant_specs.php?id=".$_GET['id']?>>Edit restaurant information</a>
            <a href=<?php echo"add_restaurant_dishes.php?Ri=".$_GET['id']."&e=t"?>>Manage your restaurant's dishes</a>
        </div>
    </body>
</html>