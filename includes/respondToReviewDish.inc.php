<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit"])) { // IF SEARCHED CORRECTLY
    if (isset($_GET["id"])) {
        $idForReview = $_GET["id"];
        $idForDish = $_GET["di"];
        $restaurantId = $_GET["r"];
        $content = $_POST["contentOfResponse"];
        insertResponseDish($idForReview, $content, $idForDish, $restaurantId ,$db);
        getAllReviewResponsesDish($db);
        header("location: ../dish.php?id=$idForDish&r=$restaurantId");
        exit();
    }   
    else {
        header("location: ../dish.php?id=$idForDish&r=$restaurantId");
        exit(); 
    }
}
else {
    header("location: ../dish.php?id=$idForDish&r=$restaurantId");
    exit();
}

