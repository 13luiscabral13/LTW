<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit"])) {
    $dishName = $_POST["name"];
    $dishDescription = $_POST["description"];
    $dishPrice = $_POST["price"];
    $dishCategory = $_POST["categories"];
    $Rid = $_GET["Ri"];
    if (invalidPrice($dishPrice)) {
        if ($_GET["e"] == "t") {
            header("location: ../create_dish.php?Ri=".$_GET["Ri"]."&cr=y&e=t&error=invalidPrice");
            exit();
        }
        else {
            header("location: ../create_dish.php?Ri=".$_GET["Ri"]."&cr=y&error=invalidPrice");
            exit();
        }
    }
    else if (emptyInputCreateDish($dishName, $dishDescription, $dishPrice, $dishCategory)) {
        if ($_GET["e"] == "t") {
            header("location: ../create_dish.php?Ri=".$_GET["Ri"]."&cr=y&e=t&error=emptyinput");
            exit();
        }
        else {
            header("location: ../create_dish.php?Ri=".$_GET["Ri"]."&cr=y&error=emptyinput");
            exit();
        }
    }

    $dishPic = $_FILES["dishPic"];

    $dishId = createDish($db,$dishName, $dishDescription, $dishPrice, $dishCategory, $Rid); //adicionar dishPic?
    
    var_dump($_FILES["dishPic"]);
        
    if($_FILES["dishPic"]["full_path"] != ""){ //verificar que o path não está vazio
        move_uploaded_file($_FILES["dishPic"]["tmp_name"], "../dishesPics/".$dishId.".jpg");
    }

    getNumOfRestaurants($db);
    setAllRestaurantReviewsToZero();
    getAllUsersInASession($db);
    getAllRestaurantsInASession($db);
    getAllRestaurantReviewsInASession($db);
    getAllNumOfRestReviews($db);
    getNumOfAllDishes($db);
    getAllDishesInASession($db);
    getAllDishReviewsInASession($db);
    getAllNumOfDishReviews($db);
    getOwnedRestaurants($_SESSION["userid"], $db);

    if ($_GET["cr"] == 'y') {
        if ($_GET["e"] == 't') {
        header("location: ../add_restaurant_dishes.php?Ri=".$Rid."&e=t");
        }
        else {
        header("location: ../add_restaurant_dishes.php?Ri=".$Rid);
        }
        exit();
    }
    else {
        header("location: ../add_restaurant_dishes.php?Ri=".$Rid);
    }



}
