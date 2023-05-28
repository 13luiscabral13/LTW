<?php
session_start();

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_GET["id"])) {

    // ATTRIBUTES INITIALIZATION

    $id = $_GET['id'];

    $email = $_POST["email"];
    $rname = $_POST["rname"];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $bio = $_POST['bio'];
    $description = $_POST["description"];
    

    // ERROR HANDLING


    $_SESSION['restaurant'.$id]['Rname'] = $rname;
    $_SESSION['restaurant'.$id]['email'] = $email;
    $_SESSION['restaurant'.$id]['city'] = $city;
    $_SESSION['restaurant'.$id]['morada'] = $address;
    $_SESSION['restaurant'.$id]['slogan'] = $bio;
    $_SESSION['restaurant'.$id]['bio'] = $description;


    $stmt = $db->prepare("UPDATE restaurants SET email=?, Rname=?, morada=?, city=?, slogan=?, bio=? WHERE id=$id;");
    $stmt->execute(array($email, $rname, $address, $city, $bio, $description));

    header("location: ../restaurant.php?id=".$id);
    exit();

}