<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_GET["i"])) {
    $userId = $_GET["i"];
    getOwnedRestaurants($userId, $db);
    getAllUsersInASession($db);
    header("location: ../my_restaurants.php");
}