<?php 

require_once 'functions.inc.php';
require_once 'dbh.inc.php';


if (isset($_GET["id"])) {
    $rID = $_GET["Ri"];
    $dishId = $_GET["id"];
    deleteDish($dishId, $db);
    getAllDishesInASession($db);
    if ($_GET["e"] == 't') {
        header("location: ../add_restaurant_dishes.php?Ri=$rID&e=t");
        exit();
    }
    else {
        header("location: ../add_restaurant_dishes.php?Ri=$rID");
        exit();
    }
    
}