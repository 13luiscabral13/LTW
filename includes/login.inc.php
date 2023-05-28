<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $psw = $_POST["psw"];

    if ($_GET["cr"] == 'y') {
    if (emptyInputLogin($username, $psw) !== false) {
        header("location: ../login.php?error=emptyinput&cr=y");
        exit();
    }
}
else {
    if (emptyInputLogin($username, $psw) !== false) {
        header("location: ../login.php?error=emptyinput");
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
    loginUser($db, $username, $psw, $cr); // CREATED IN FUNCTIONS.INC.PHP
}

else {
    header("location: ../login.php");
    exit();
}

