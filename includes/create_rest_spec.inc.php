<?php
require_once 'functions.inc.php';
require_once 'dbh.inc.php';


if ($_POST["categories"] == "none") {
    $id = $_GET["Ri"];
    header("location: ../create_restaurant_spec.php?Ri=$id&error=novalue");
    exit();
}
if (isset($_GET["Ri"])) {
    $id = $_GET["Ri"];
    $categoria = $_POST["categories"];
    UpdateRestaurantCategory($id, $categoria, $db);
    getAllRestaurantsInASession($db);
    header("location: ../add_restaurant_dishes.php?Ri=".$id);
    exit();
}
