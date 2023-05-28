<?php 
include_once("session.php");
include_once("backtoindex.php");
?>



<!DOCTYPE html>
<html lan = "en-US">
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <link href= "css/style_register.css" rel="stylesheet">
    </head>
    <body>
    <?php
        if ($_GET["cr"]== 'y') {
            $string = 'includes/signup.inc.php?cr=y';
        }
        else {
            $string = 'includes/signup.inc.php';
        }
    ?>
        <form action="<?php echo $string ?>" enctype="multipart/form-data" method="post">
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter email" name="email" id="email">

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter username" name="username" id="username">

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw">

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw_repeat" id="psw_repeat">
 
                
                <p>By creating an account you agree to our <a href="termsandconditions.php">Terms & Privacy</a>.</p>

                <button type="submit" name = "submit" >Register</button>
                
            </div>

            <div class="container signin">
                <p>Already have an account? <a href="login.php">Sign in</a>.</p>
            </div>
            
        </form>
<?php 
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p> Please fill in all inputs! </p>";
        }
        else if ($_GET["error"] == "invalidusername") {
            echo "<p> Invalid Username! </p>";
        }
        else if ($_GET["error"] == "invalidemail") {
            echo "<p> Invalid Email! </p>";
        }
        else if ($_GET["error"] == "pswdontmatch") {
            echo "<p> Passwords do not match! </p>";
        }
        else if ($_GET["error"] == "usernametaken") {
            echo "<p> Username taken! </p>";
        }
        else {
            echo "<p> Your account has been created! </p>";
            header("location: edit_profile.php");
        }
    }


?>
    </body>
    <?php require_once("footer.php") ?>
</html>

