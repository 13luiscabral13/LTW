<?php 

    session_start();

    $restId = $_GET['rId'];
    $dishID = $_GET['dishId'];

    $_SESSION["order"] = $dishID;
?>