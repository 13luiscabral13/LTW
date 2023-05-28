<?php 
include_once("session.php");
include_once("backtoindex.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Restaurant</title>
        <meta charset="UTF-8">
        <link href= "css/style_verify.css" rel="stylesheet">
    </head>
    <body>
        <h1>We noticed you are not logged in...</h1>
        <h2>Do you already have an account?</h2>
        <div>
            <a href="login.php?cr=y">Yes, let me login</a>
            <a href="signup.php?cr=y">No, I want to create my account</a>
        </div>
    </body>
</html>