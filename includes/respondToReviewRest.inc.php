<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit"])) { // IF SEARCHED CORRECTLY
    if (isset($_GET["id"])) {
        $idForReview = $_GET["id"];
        $restaurantId = $_GET["Ri"];
        $dishId = $_GET["di"];
        $content = $_POST["contentOfResponse"];
        insertResponseRest($idForReview, $content, $restaurantId, $db);
        getAllReviewResponsesRest($db);
        header("location: ../restaurant.php?id=$restaurantId");
        exit();
    }   
    else {
        header("location: ../restaurant.php?id=$restaurantId");
        exit(); 
    }
}
else {
    header("location: ../restaurant.php?id=$restaurantId");
    exit();
}

