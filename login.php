<?php 
include_once("session.php");
include_once("backtoindex.php");
?>
<!DOCTYPE html>
<html lan = "en-US">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <link href="css/style_login.css" rel="stylesheet">
    </head>
    <body>
        <?php 
        if ($_GET["cr"] == "y") {
            echo '<form action="includes/login.inc.php?cr=y" method="post">';
        }
        else {
        echo '<form action="includes/login.inc.php" method="post">';
        }
        ?>
            <div class="imgcontainer">
                <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" >

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" >

                <button type="submit" name = "submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                    <span class="psw"> <a href="#">Forgot password?</a></span>
                
                </label>
            </div>
            
        </form>

        <?php 
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p> Please fill in all spaces! </p>";
        }
        else if ($_GET["error"] == "wronglogin") {
            echo "<p> Wrong credential information! </p>";
        }
    }
?>
        <div>
            <p> Don't have an account yet? <?php 
            if ($_GET["cr"] == 'y') {
            echo'<a href="signup.php?cr=y">' ;
            }
            else {
                echo'<a href = "signup.php">';
            }
            ?>Register</a>.</p>
        </div>
    </body>
    <?php require_once("footer.php") ?>
</html>