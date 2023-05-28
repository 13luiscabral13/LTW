<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit-search"])) { // IF SEARCHED CORRECTLY
    if (search($_POST['search'], $db) !== false) {
        getAllUsersInASession($db);
        getAllRestaurantsInASession($db);
        getAllRestaurantReviewsInASession($db);
        getAllNumOfRestReviews($db);
        getNumOfAllDishes($db);
        getAllDishesInASession($db);
        getAllDishReviewsInASession($db);
        getAllNumOfDishReviews($db);
        header("location: ../index.php?r=r");
        exit();
    }
    else {
        header("location: ../index.php?r=f");
        exit();
    }
}   
else {
    header("location: ../index.php?error=submitFailed");
    exit();
}

