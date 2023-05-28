<?php
session_start();

require_once 'functions.inc.php';
require_once 'dbh.inc.php';

if (isset($_SESSION["userid"])) { // IF LOGGED IN
    header("location: ../create_restaurant.php?l=".$_SESSION["userid"]);
    exit();
}
else { // IF NOT LOGGED IN
    header("location: ../create_restaurant_verify.php");
    exit();
}