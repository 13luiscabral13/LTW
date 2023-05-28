<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';


if (isset($_POST["submit"])) {

    // ATTRIBUTE SPECIFICATION

    $email = $_POST["email"];
    $username = $_POST["username"];
    $psw = $_POST["psw"];
    $psw_repeat = $_POST["psw_repeat"];

    if ($_GET["cr"] == 'y') {
        $cr = 1;
    }
    else {
        $cr = 0;
    }
    // ERROR HANDLING
    
    if (emptyInputSignup($email, $username, $psw, $psw_repeat) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../signup.php?error=emptyinput&cr=y");
            exit();
        }
        else {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }
    }
    if (invalidUsername($username) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../signup.php?error=invalidusername&cr=y");
            exit();
        }
        else {
            header("location: ../signup.php?error=invalidusername");
            exit();
        }    
    }
    if (invalidEmail($email, $username, $psw, $psw_repeat) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../signup.php?error=invalidemail&cr=y");
            exit();
        }
        else {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
    }
    if (pswMatch($psw, $psw_repeat) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../signup.php?error=pswdontmatch&cr=y");
            exit();
        }
        else {
            header("location: ../signup.php?error=pswdontmatch");
            exit();
        }
    }
    if (usernameExists($db, $username, $email) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../signup.php?error=usernametaken&cr=y");
            exit();
        }
        else {
            header("location: ../signup.php?error=usernametaken");
            exit();
        }
    }


    session_start();
    if ($_GET["cr"] == 'y') {
        $_SESSION["cr"] = true;
        $_SESSION["goto"] = "../create_restaurant.php?l=";
        $cr = 1;
    }
    else {
        $_SESSION["goto"] = "../index.php";
        $cr = 0;
    }
    
    createUser($db, $email, $username, $psw, $cr);
    

}
else {
    header("location: ../signup.php");
    exit();
}
?>