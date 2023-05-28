<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit"])) { // IF SEARCHED CORRECTLY
    if (isset($_GET["id"])) {
        $idForRestaurant = $_GET["id"];
        $score = $_POST["rate"];
        $content = $_POST["contentOfReview"];
        insertReviewRest($idForRestaurant, $content, $score, $db);
    }   
    else {
        header("location: ../index.php?");
        exit(); 
    }
}
else {
    header("location: ../index.php");
    exit();
}

