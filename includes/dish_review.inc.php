<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit"])) { // IF SEARCHED CORRECTLY
    if (isset($_GET["id"])) {
        $idForDish = $_GET["id"];
        $restaurantId = $_GET["r"];
        $score = $_POST["rate"];
        $content = $_POST["contentOfReview"];
        insertReviewDish($idForDish, $content, $score, $db, $restaurantId);
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

