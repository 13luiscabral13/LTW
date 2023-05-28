<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_GET["id"])) { // IF SEARCHED CORRECTLY
    $id = $_GET['id'];
    $name = getCategoriaName($id);
    if ((categoriaDish($name, $db, $id) !== false) || (categoriaRest($name, $db, $id) !== false)) {
        getAllUsersInASession($db);
        getAllRestaurantsInASession($db);
        getAllRestaurantReviewsInASession($db);
        getAllNumOfRestReviews($db);
        getNumOfAllDishes($db);
        getAllDishesInASession($db);
        getAllDishReviewsInASession($db);
        session_start();
        $_SESSION["thisCategoria"] = $name;
        header("location: ../categoria.php?id=".$id);
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
