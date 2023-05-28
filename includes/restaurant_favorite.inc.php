<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_GET["error"])) {
    $rId = $_GET['id']; 
    header("location: ../restaurant.php?id=".$rId."&error=notLoggedInF");
    exit();
}
else if (isset($_GET["active"])) {
    if ($_GET["active"] == 0) { // NOT FAVORITE
        $rId = $_GET['id']; 
        markFavorite($rId, $db);
        header("location: ../restaurant.php?id=".$rId);
        exit();
    }
    else { // FAVORITE
        $rId = $_GET['id'];
        unmarkFavorite($rId, $db);
        header("location: ../restaurant.php?id=".$rId);
        exit();
    }
}



