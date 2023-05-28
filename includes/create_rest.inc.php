<?php
require_once 'functions.inc.php';
require_once 'dbh.inc.php';
session_start();

if(isset($_POST["submit"])){
    $email;
    $psw;
    if ($_GET["l"] != 0) {
        $email = $_SESSION["useremail"];
        $psw = $_SESSION["userpsw"];
    }
    else {
        $email = $_POST["email"];
        $psw = $_POST["psw"];
    }
    $name = $_POST["name"];
    $city = $_POST["city"];
    $description = $_POST["description"];
    $slogan = $_POST["slogan"];
    $address = $_POST["address"];
    if (emptyInputRestaurant($email, $psw, $name, $city, $description, $slogan, $address) !== false){
        header("location: ../create_restaurant.php?error=emptyinput&l=".$_GET["l"]);
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../create_restaurant.php?error=invalidemail&l=".$_GET["l"]);
        exit();
    }
    createRestaurant($db, $email, $name, $psw, $city, $description, $slogan, $address);

}
else {
    header("location: ../create_restaurant.php");
    exit();
}