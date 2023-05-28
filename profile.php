<?php 
include_once("session.php");
include_once("backtoindex.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
      <link href="css/style_profile.css" rel="stylesheet">
    </head>
    <body>

        <header>
            <h1>Profile</h1>
            <img id ="profilepic" src=<?php echo "profilePics/" . $_SESSION['userid'] . ".png"?> alt="" />

            <?php
            $username = $_SESSION['user'];
            echo "<h2> $username </h2>";
            ?>

            <?php 
                $phonenumber = $_SESSION['userphone'];
                $address = $_SESSION['useraddress'];
                echo "<p> $phonenumber </p>";
                echo "<p> $address </p>";
            ?>
        </header>
        <main>
            <container id="bio">
                <h2>Bio</h2>
                <p>
                    <?php
                        $bio = $_SESSION['userbio'];
                        echo "<b> $bio </b>";
                    ?>
                </p>
            </container>
        
            <div>

        
                <div class="stats">
                    <a href = "reviews.php">Reviews</a>
                    <?php 
                        $numOfReviews = $_SESSION['userNumOfReviews'];
                        echo "<span> $numOfReviews </span>"; 
                    ?>
               </div>

                <div class="stats">
                    <a href = "favorites.php">Favorites</a>
                    <?php 
                        $numOfFavorites = $_SESSION['userNumOfFavorites'];
                        echo "<span> $numOfFavorites </span>"; 
                    ?>
                </div>
            </div>

            <div class = "button-container">
                <button type = "edit-profile" name = "edit-profile"><a href="edit_profile.php">✎ Edit Profile</a></button>
            </div>
        </main>
    </body>
</html>
