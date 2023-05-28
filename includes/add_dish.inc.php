<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["create"])) {
    if ($_GET["e"] == 't') {
        header("location: ../create_dish.php?Ri=".$_GET["Ri"]."&cr=y&e=t");
    }
    else {
    header("location: ../create_dish.php?Ri=".$_GET["Ri"]."&cr=y");
    }
    exit();
}
else if (isset($_POST["leave"])) {
    getAllRestaurantsInASession($db);
    header("location: ../restaurant.php?id=".$_GET["Ri"]);
    exit();
}