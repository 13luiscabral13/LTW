<?php
session_start();

require_once 'functions.inc.php';
require_once 'dbh.inc.php';


    // ATTRIBUTES INITIALIZATION

    $email = $_POST["email"];
    $username = $_POST["username"];
    $phonenu = $_POST['phonenu'];
    $address = $_POST['address'];
    $bio = $_POST['bio'];
    $profilePic = $_FILES["profilePic"];
    

    // ERROR HANDLING


    if (verifyPhoneNumber($phonenu) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../edit_profile.php?error=invalidphonenumber&cr=y");
            exit();
        }
        else {
            header("location: ../edit_profile.php?error=invalidphonenumber");
            exit();
        }
    }

    if (emptyInputSignup($email, $username, $phonenu, $address) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../edit_profile.php?error=emptyinput&cr=y");
            exit();
        }
        else {
            header("location: ../edit_profile.php?error=emptyinput");
            exit();
        }
    }
    if (invalidUsername($username) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../edit_profile.php?error=invalidusername&cr=y");
            exit();
        }
        else {
            header("location: ../edit_profile.php?error=invalidusername");
            exit();
        }    
    }
    if (invalidEmail($email, $username, $psw, $psw_repeat) !== false) {
        if ($_GET["cr"] == 'y') {
            header("location: ../edit_profile.php?error=invalidemail&cr=y");
            exit();
        }
        else {
            header("location: ../edit_profile.php?error=invalidemail");
            exit();
        }
    }
    // SESSION INITIALIZATION

    $_SESSION['user'] = $username;
    $_SESSION['useremail'] = $email;
    $_SESSION['userphone'] = $phonenu;
    $_SESSION['useraddress'] = $address;
    $_SESSION['userbio'] = $bio;
    $userId = $_SESSION['userid'];


    $stmt = $db->prepare("UPDATE users SET email=?, username=?, morada=?, phonenu=?, bio=? WHERE id=$userId;");
    $stmt->execute(array($email, $username, $address, $phonenu, $bio));


    var_dump($_FILES["profilePic"]);
        
    if($_FILES["profilePic"]["full_path"] != ""){ //verificar que o path não está vazio
        echo $_FILES["profilePic"]; 
        move_uploaded_file($profilePic["tmp_name"], "../profilePics/".$userId.".png");
    }
    else{ //verificar se o nome é uma string vazia
        copy("../images/defaultProfilePic.png", "../profilePics/".$userId.".png");
    }

    if ($_GET["cr"] == 'y') {
        session_start();
        $var = $_SESSION["goto"].$_SESSION["userid"];
        header("location: $var");
        exit();
    }
    header("location: ../profile.php");
    exit();