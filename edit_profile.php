<?php 
include_once("session.php");
?>
    
<!DOCTYPE html>
<html lan = "en-US">
    <head>
        <title>Edit Profile</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    <body> <?php
        if ($_GET["cr"]== 'y') {
            $string = 'includes/edit_profile.inc.php?cr=y';
        }
        else {
            $string = 'includes/edit_profile.inc.php';
        }
        ?>
        <form action = "<?php echo $string ?>" enctype="multipart/form-data" method = "post">
            <div class="container">
                <h1>Edit Profile</h1>
                <p>Customize your profile to best suit you!</p>
                <hr>
                <br> <br> <br>
                <label for="email"><b>Email</b></label>
                <input type="text" name="email" id="email" value = "<?= $_SESSION['useremail']; ?>">

                <label for="username"><b>Username</b></label>
                <input type="text" name="username" id="username" value = "<?= $_SESSION['user']; ?>">

                <label for="phonenu"><b>Phone Number</b></label>
                <input type="text" name="phonenu" id="phonenu" value = <?php 
                if (!empty($_SESSION['userphone'])) { // IF NOT CREATED YET, DOES NOT DISPLAY
                echo $_SESSION['userphone']; 
                }
                ?>>

                <label for="address"><b>Address</b></label>
                <?php if (!empty($_SESSION['useraddress'])) { // IF NOT CREATED YET, DOES NOT DISPLAY
                 $valueAdd = $_SESSION['useraddress']; 
                }
                ?>
                <input type="text" name="address" id="address" value = "<?= $valueAdd ?>">

                <label for="bio"><b>Bio</b></label>
                <?php
                if (!empty($_SESSION['userbio'])) { // IF NOT CREATED YET, DOES NOT DISPLAY
                 $valueBio = $_SESSION['userbio']; 
                }
                ?>
                <input type="text" name="bio" id="bio" value = "<?= $valueBio ?>">

                <label for="profilePic"><b>Upload profile picture (optional, can be done later)</b></label>
                <br><br>
                <input type="file" name="profilePic">

                <hr>

                <button type="submit" name = "submit" >Edit Profile</button>
                
            </div>
            <?php 
            
            // ERROR HANDLING

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p> Please fill in all spaces! </p>";
        }
        else if ($_GET["error"] == "invalidusername") {
            echo "<p> Invalid Username </p>";
        }
        else if ($_GET["error"] == "invalidemail") {
            echo "<p> Invalid email! </p>";
        }
        else if ($_GET["error"] == "invalidphonenumber") {
            echo "<p> Invalid phone number! </p>";
        }
    }


?>
        </form>
        <?php require_once("footer.php") ?>
    </body>
