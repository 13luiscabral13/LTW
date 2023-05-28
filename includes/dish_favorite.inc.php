<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_GET["error"])) {
    $dId = $_GET['id']; 
    header("location: ../dish.php?id=".$dId."&error=notLoggedInF");
    exit();
}
else if (isset($_GET["active"])) {
    if ($_GET["active"] == 0) { // NOT FAVORITE
        $dId = $_GET['id']; 
        $rid = $_GET['r'];
        markFavoriteDish($dId, $db, $rid);
        header("location: ../dish.php?id=".$dId."&r=".$rid);
        exit();
    }
    else { // FAVORITE
        $dId = $_GET['id']; 
        $rid = $_GET['r'];
        unmarkFavoriteDish($dId, $rid, $db);
        header("location: ../dish.php?id=".$dId."&r=".$rid);
        exit();
    }
}

