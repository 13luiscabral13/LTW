<?php

function emptyInputSignup($email, $username, $psw, $psw_repeat) {
    $result;
    if (empty($username) || empty($email) || empty($psw) || empty($psw_repeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { // ONLY a-z or A-Z or 0-9, UNLIMITED DIMENSION
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // PRE-ESTABLISHED FILTER
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pswMatch($psw, $psw_repeat) {
    $result;
    if ($psw !== $psw_repeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function usernameExists($db, $username, $email) {
    $stmt = $db->prepare("SELECT * FROM users WHERE username =? OR email = ?;");
    $stmt->execute(array($username, $email));
    $row = $stmt->fetch();
    if ($row !== false) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
}

function usernameExistsLogin($db, $username) {
    $stmt = $db->prepare("SELECT * FROM users WHERE username = '$username' OR email = '$username';");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row !== false) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
}


function createUser($db, $email, $username, $psw, $cr) {
    try{
    //setAttribute is used to set an attribute with given name to the given value
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO users(username, email, psw, numOfReviews) VALUES (?,?,?,?);");
    $hashedPsw = password_hash($psw, PASSWORD_DEFAULT);
    $stmt->execute(array($username, $email, $hashedPsw, 0));

    //Contém informação sobre o user
    $usernameExists = usernameExistsLogin($db, $username);
    session_start();
    $_SESSION["userid"] = $usernameExists["id"];
    $_SESSION["user"] = $usernameExists["username"];
    $_SESSION["useremail"] = $usernameExists["email"];
    $_SESSION["useraddress"];
    $_SESSION["userphonenu"];
    $_SESSION["userpsw"] = $usernameExists["psw"];
    $_SESSION["userNumOfReviews"] = 0;
    $_SESSION["userNumOfFavorites"] = 0;
    $_SESSION[$_SESSION["userid"]."ownedRestaurantNumber"]= 0;
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
    getAllReviewResponsesDish($db);
        getAllReviewResponsesRest($db);
    if ($cr == 1) {
    header("location: ../edit_profile.php?cr=y");
    exit();
    }
    else {
        header("location: ../edit_profile.php");
        exit();
    }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function restaurantnameExists($db, $Rname, $email){
    $stmt = $db->prepare("SELECT * FROM restaurants WHERE Rname=? OR email=?;");
    $stmt->execute(array($Rname, $email));
    $row = $stmt->fetch();
    if($row !== false){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
}

function createRestaurant($db, $email, $Rname, $psw, $city, $info, $slogan, $address){
    try{
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $id = getIdForRestaurant($db);
        $hashedPsw = password_hash($psw, PASSWORD_DEFAULT); // HASH PASSWORD
        $stmt = $db->prepare("INSERT INTO restaurants(email, Rname, psw, city, slogan, bio, morada, numOfReviews, avgScore, dono) VALUES (?,?,?,?,?,?,?,?,?,?);");
        $array = array($email, $Rname, $hashedPsw, $city, $slogan, $info, $address, 0, 0,  $_SESSION["userid"]);
        $stmt->execute($array);
        session_start();
        $string = "restaurant".$id;
        $_SESSION[$string]['Rname'] = $Rname;
        $_SESSION[$string]['city'] = $city;
        $_SESSION[$string]['slogan'] = $slogan;
        $_SESSION[$string]['bio'] = $info;
        $_SESSION[$string]['morada'] = $address;
        $_SESSION[$string]['numOfReviews'] = 0;
        $_SESSION[$string]['avgScore'] = 0;
        $_SESSION[$string]['dono'] = $_SESSION["userid"];
        $_SESSION["restaurant".$id."numberOfReviews"] = 0;
        $_SESSION[$id."dishes"] = 0;
        getAllRestaurantsInASession($db);
        getAllDishesInASession($db);
        getAllUsersInASession($db);
        header("location: ../create_restaurant_spec.php?Ri=$id");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    exit();
}

function emptyInputLogin($username, $psw) {
    $result;
    if (empty($username) || empty($psw)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($db, $username, $psw, $cr) {
    $usernameExists = usernameExistsLogin($db, $username); // VERIFY IF USER EXISTS
    if ($usernameExists === FALSE) {
        if ($cr == 1) {
        header("location: ../login.php?error=wronglogin&cr=y");
        exit();
        }
        else {
        header("location: ../login.php?error=wronglogin");
        exit();
        }
    }

    $pwdHashed = $usernameExists["psw"];
    $checkPsw = password_verify($psw, $pwdHashed);

    if ($checkPsw === FALSE) {
        if ($cr == 1) {
            header("location: ../login.php?error=wronglogin&cr=y");
            exit();
        }
        else {
            header("location: ../login.php?error=wronglogin");
            exit();
        }
    }

    else if ($checkPsw == TRUE) {
        session_start();
        $_SESSION["userid"] = $usernameExists["id"];
        $_SESSION["user"] = $usernameExists["username"];
        $_SESSION["useremail"] = $usernameExists["email"];
        $_SESSION["userpsw"] = $usernameExists["psw"];
        $_SESSION["userbio"] = $usernameExists["bio"];
        $_SESSION["useraddress"] = $usernameExists["morada"];
        $_SESSION["userphone"] = $usernameExists["phonenu"];
        getNumOfRestaurants($db);
        getNumOfUserFavorites($_SESSION["userid"], $db);
        getNumOfUserReviews($_SESSION["userid"], $db);
        getFavoriteRestaurants($_SESSION["userid"], $db);
        getReviewedRestaurants($_SESSION["userid"], $db);        
        getSingleRestaurantReviewsByUser($_SESSION["userid"],$db);
        getAllRestaurantsInASession($db);
        getAllDishesInASession($db);
        getAllUsersInASession($db);
        getAllRestaurantReviewsInASession($db);
        getAllNumOfRestReviews($db);
        getNumOfAllDishes($db);
        getAllDishReviewsInASession($db);
        getAllNumOfDishReviews($db);
        getAllReviewResponsesDish($db);
        getAllReviewResponsesRest($db);
        if (isset($_SESSION["cr"])) {
            $var = $_SESSION["goto"].$_SESSION["userid"];
            header("location: $var");
            exit();
        }
        else {
            $var = $_SESSION['goto'];
            header("location: $var");
            exit();
        }
    }
}

function search($search, $db) { 
    $sql = ("SELECT * FROM restaurants WHERE Rname LIKE '$search' OR city LIKE '$search' OR avgScore >= '$search'; "); // VERIFY BY NAME AND CITY
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$r) {
        $sqlT = ("SELECT * FROM dishes WHERE nome LIKE '$search';");
        $stmtT = $db->prepare($sqlT);
        $stmtT->execute();
        $rD = $stmtT->fetchAll(PDO::FETCH_ASSOC);
        if (!$rD) {
            return false;
        }
        else {

        
        foreach ($rD as $row => $dishFound) {
            $rId = $dishFound['restaurantId'];
            $sqlTh = ("SELECT * FROM restaurants where id='$rId';");
            $stmtTh = $db->prepare($sqlTh);
            $stmtTh->execute();
            $rR = $stmtTh->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['search'] = $rR;
            
            
        }
        return true;
    }
    }
    else {
        session_start();
        $_SESSION['search'] = $r;
    }
}

function verifyPhoneNumber($phone) {
    if(preg_match('/^[0-9]{9}+$/', $phone)) { // ONLY NUMBERS, 9 DIMENSION
        $result = false;
        return $result; 
    } else {
        $result = true;
        return $result;
    }
}

function emptyInputRestaurant($email, $username, $psw, $psw_repeat, $a, $b) {
    $result;
    if (empty($username) || empty($email) || empty($psw) || empty($psw_repeat) || empty($a) || empty($b)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function getIdForRestaurant($db) {
    $counter = 1;
    $stmt = $db->prepare("SELECT Rname FROM restaurants;");
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$r) {
        return false;
    }
    else {
        foreach($r as $row => $elm) {
            $_SESSION["restaurant".$counter."numOfReviews"] = 0;
            $counter++;
        }
        return $counter;
    }
}

function getAllNumOfRestReviews($db) {
    $stmt = $db->prepare("SELECT count(*) from restaurantReviews;");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    $_SESSION["allRestReviews"] = $result;
    return $result;
}

function getAllNumOfDishReviews($db) {
    $stmt = $db->prepare("SELECT count(*) from dishesReviews;");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    $_SESSION["allDishReviews"] = $result;
    return $result;
}


function getNumOfReviews($restaurantId, $db) {
    $stmt = $db->prepare("SELECT count(*) AS numOfReviews FROM restaurantReviews WHERE Rid='$restaurantId';");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if (!$result) {
        return false;
    }
    else {
        $stmt = $db->prepare("UPDATE restaurants SET numOfReviews = :numOfReviews WHERE id='$restaurantId';");
        $stmt->bindValue(':numOfReviews', $result);
        $stmt->execute();
        $string = "restaurant$restaurantId";
        session_start();
        $_SESSION[$string]['numOfReviews'] = $result;
    }
}

function getNumOfReviewsDish($dishId, $db, $restaurantId) {
    $stmt = $db->prepare("SELECT count(*) AS numOfReviews FROM dishesReviews WHERE dishId='$dishId';");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if (!$result) {
        return false;
    }
    else {
        $stmt = $db->prepare("UPDATE dishes SET numberOfReviews = :numberOfReviews WHERE id='$dishId';");
        $stmt->bindValue(':numberOfReviews', $result);
        $stmt->execute();
        $string = $restaurantId."dish".$dishId;
        session_start();
        $_SESSION[$string]['numOfReviews'] = $result;
    }
}

function getAvgScore($restaurantId, $db) {
    $stmt = $db->prepare("SELECT avg(score) AS avgScore FROM restaurantReviews WHERE Rid='$restaurantId';");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if (!$result) {
        return false;
    }
    else {
        $stmt = $db->prepare("UPDATE restaurants SET avgScore = :avgScore WHERE id='$restaurantId'");
        $stmt->bindValue(':avgScore', $result);
        $stmt->execute();
        $string = "restaurant$restaurantId";
        session_start();
        $_SESSION[$string]['avgScore'] = $result;
    }
}

function getAvgScoreDish($dishId, $db, $restaurantId) {
    $stmt = $db->prepare("SELECT avg(score) AS avgScore FROM dishesReviews WHERE dishId='$dishId';");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if (!$result) {
        return false;
    }
    else {
        $stmt = $db->prepare("UPDATE dishes SET avgScore = :avgScore WHERE id='$dishId'");
        $stmt->bindValue(':avgScore', $result);
        $stmt->execute();
        $string = $restaurantId."dish".$dishId;
        session_start();
        $_SESSION[$string]['avgScore'] = $result;
    }
}

function insertReviewRest($restaurantId, $content, $rating, $db) {
    session_start();
    $userId = $_SESSION["userid"];
    if (empty($userId)) {
        header("location: ../restaurant.php?id=$restaurantId&error=notLoggedIn");
    }
    else {
    $stmt = $db->prepare("INSERT INTO restaurantReviews(Rid, score, content, userId) VALUES ('$restaurantId', '$rating', '$content', '$userId');");
    $stmt->execute();
    $stmtTwo = $db->prepare("UPDATE users SET numOfReviews=numOfReviews+1 WHERE id = '$userId';");
    $stmtTwo->execute();
    $_SESSION["restaurant".$restaurantId."numberOfReviews"]++;
    getReviewedRestaurants($userId, $db);
    $_SESSION["allRestReviews"]++;
    $number = $_SESSION["allRestReviews"];
    $string = $restaurantId."review".$number;
    $_SESSION[$string]['exists'] = true;
    $_SESSION[$string]['user'] = $_SESSION[$userId."user"]['username'];
    $_SESSION[$string]["content"] = $content;
    $_SESSION[$string]["score"] = $rating;
    if (getAvgScore($restaurantId, $db) === FALSE) {
        header("location: ../restaurant.php?id=$restaurantId&error=GettingAvg");
        exit();
    }
    else if (getNumOfReviews($restaurantId, $db) === FALSE) {
        header("location: ../restaurant.php?id=$restaurantId&error=GettingNumOfReviews");
        exit();
    }
    else if (getNumOfUserReviews($userId, $db) === FALSE) {
        header("location: ../restaurant.php?id=$restaurantId&error=GettingNumOfReviewsFromUser");
        exit();
    }
    else {
        header("location: ../restaurant.php?id=$restaurantId");
        exit();
    }
}
}

function getAllRestaurantReviewsInASession($db) {
    $stmt = $db->prepare("SELECT * FROM restaurantReviews;");
    $stmt->execute();
    $AllReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counter = 0;
    foreach ($AllReviews as $row => $review) {
        $counter++;
        $_SESSION[$review['Rid']."review".$counter] = $review;
        $_SESSION[$review['Rid']."review".$counter]["exists"] = true;
        $_SESSION[$review['Rid']."review".$counter]['user'] = $_SESSION[$review['userId']."user"]['username'];
    }
}

function getNumOfUserReviews($userId, $db) {
    $stmt = $db->prepare("SELECT count(*) as numOfReviews FROM restaurantReviews WHERE userid = '$userId';");
    $stmt->execute();
    $resultRestaurant = $stmt->fetchColumn();
    $stmtTwo = $db->prepare("SELECT count(*) as numOfReviews FROM dishesReviews WHERE userid = '$userId';");
    $stmtTwo->execute();
    $resultDish = $stmtTwo->fetchColumn();
    if (!$resultRestaurant && !$resultDish) {
        $_SESSION['userNumOfRestReviews'] = 0;
        $_SESSION['userNumOfDishReviews'] = 0;
        $_SESSION['userNumOfReviews'] = 0;
        return false;
    }
    else {

        session_start();
        $_SESSION['userNumOfRestReviews'] = $resultRestaurant;
        $_SESSION['userNumOfDishReviews'] = $resultDish;
        $_SESSION['userNumOfReviews'] =  $resultRestaurant + $resultDish;
    }
}


function markFavorite($restaurantId, $db) {
    session_start();
    $userId = $_SESSION["userid"];
    if (empty($userId)) {
        header("location: ../restaurant.php?id=$restaurantId&error=notLoggedInFavorite");
    }
    else {
        $stmt = $db->prepare("INSERT INTO restaurantFavorites(userid, Rid) VALUES(?,?);");
        $stmt->execute(array($userId, $restaurantId));
        $string = "restaurant".$restaurantId."favorite";
        $_SESSION[$string] = true;
        $_SESSION["userNumOfFavorites"]++;
    }
}


function markFavoriteDish($dishId, $db, $rId) {
    session_start();
    $userId = $_SESSION["userid"];
    if (empty($userId)) {
        header("location: ../dish.php?id=$dishId&r=$rId&error=notLoggedInFavorite");
    }
    else {
        $stmt = $db->prepare("INSERT INTO dishesFavorites(userid, dishId, restaurantId) VALUES(?,?,?);");
        $stmt->execute(array($userId, $dishId, $rId));
        $string = $rId."dish".$dishId."favorite";
        $_SESSION[$string] = true;
        $_SESSION["userNumOfFavorites"]++;
    }
}




function unmarkFavorite($restaurantId, $db) {
    session_start();
    $userId = $_SESSION["userid"];
    if (empty($userId)) {
        header("location: ../restaurant.php?id=$restaurantId&error=notLoggedInFavorite");
    }
    else {
        $stmt = $db->prepare("DELETE FROM restaurantFavorites WHERE userId = '$userId' AND Rid='$restaurantId';");
        $stmt->execute();
        $string = "restaurant".$restaurantId."favorite";
        $_SESSION[$string] = false;
        $_SESSION["userNumOfFavorites"]--;
    }
}

function unmarkFavoriteDish($dishId, $restaurantId, $db) {
    session_start();
    $userId = $_SESSION["userid"];
    if (empty($userId)) {
        header("location: ../dish.php?id=$dishId&r=$restaurantId&error=notLoggedInFavorite");
    }
    else {
        $stmt = $db->prepare("DELETE FROM dishesFavorites WHERE userId = '$userId' AND dishId='$dishId';");
        $stmt->execute();
        $string = $restaurantId."dish".$dishId."favorite";
        $_SESSION[$string] = false;
        $_SESSION["userNumOfFavorites"]--;
    }
}

function checkIfFavorite($restaurantId , $db) {
    session_start();
    $userId = $_SESSION["userid"];
    $stmt = $db->prepare("SELECT count(*) as numOfFavorite FROM restaurantFavorites WHERE userId='$userId' AND Rid='$restaurantId';");
    $stmt->execute();
    $resultFavorite = $stmt->fetchColumn();
    if (!$resultFavorite) {
        return false;
    }
    else {
        return true;
    }
}

function getFavoriteRestaurants($userId, $db) {
    $stmt = $db->prepare("SELECT * FROM restaurantFavorites WHERE userId = '$userId';");
    $stmt->execute();
    $resultFavorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultFavorites as $row => $restaurant) {
        $rid = $restaurant['Rid'];
        $string = "restaurant".$rid."favorite";
        $_SESSION[$string] = true;
    }
    return $resultFavorites;
}

function getNumOfUserFavorites($userId, $db) {
    $stmt = $db->prepare("SELECT count(*) FROM restaurantFavorites WHERE userId = '$userId';");
    $stmt->execute();
    $resultFavoritesNumber = $stmt->fetchColumn();
    session_start();
    if (!$resultFavoritesNumber) {
        $_SESSION["userNumOfFavorites"] = 0;
    }
    else {
        $_SESSION["userNumOfFavorites"] = $resultFavoritesNumber;
    }
}


function getNumOfRestaurants($db) {
    $stmt = $db->prepare("SELECT count(*) from restaurants");
    $stmt->execute();
    $number = $stmt->fetchColumn();
    $_SESSION["numberofrestaurants"] = $number;
}

function getReviewedRestaurants($userId,$db) {
    $stmt = $db->prepare("SELECT * FROM restaurantReviews WHERE userId='$userId';");
    $stmt->execute();
    $resultReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counter = 1;
    foreach($resultReviews as $row => $review) {
        $_SESSION[$counter."RreviewRid"] = $review['Rid'];
        $_SESSION[$counter."Rreviewcontent"] = $review["content"];
        $_SESSION[$counter."Rreviewscore"] = $review["score"];
        $counter++;
    }        
}

function getSingleRestaurantReviewsByUser($userId,$db) {
    for ($a = 1; $a <= $_SESSION["numberofrestaurants"]; $a++) {
        $stmt = $db->prepare("SELECT count(*) FROM restaurantReviews where userId='$userId' and Rid='$a';");
        $stmt->execute();
        $number = $stmt->fetchColumn();
        $_SESSION["restaurant".$a."numberOfReviews"] = $number;
    }
}

function setAllRestaurantReviewsToZero() {
    for ($a = 1; $a <= $_SESSION["numberofrestaurants"]; $a++) {
        $_SESSION["restaurant".$a."numberOfReviews"] = 0;
    }
}

function getAllRestaurantsInASession($db) {
    $stmt = $db->prepare("SELECT * FROM restaurants;");
    $stmt->execute();
    $Allrestaurant = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($Allrestaurant as $row => $restaurant) {
        $_SESSION["restaurant".$restaurant['id']] = $restaurant;
    }
}

function categoriaRest($categoria, $db, $id) {
    $sql = ("SELECT * FROM restaurants WHERE categoria LIKE '$categoria';"); 
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['categoria'.$id.'hasrestaurants'] = false;
    if (!$r) {
        return false;
    }
    else {
        $_SESSION['categoria'.$id.'hasrestaurants']= true;
        $_SESSION['categoria'.$id.'restaurants'] = $r;
    }
}

function categoriaDish($categoria, $db, $id) {
    $sql = ("SELECT * FROM dishes WHERE categoria LIKE '$categoria';"); 
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rd = $stmt->fetchAll(PDO::FETCH_ASSOC);
    session_start();
    if (!$rd) {
        $_SESSION['categoria'.$id.'hasdishes'] = false;
        return false;
    }
    else {
        $_SESSION['categoria'.$id.'hasdishes'] = true;
        $_SESSION['categoria'.$id.'dishes'] = $rd;
    }
}

function getCategoriaName($id) {
    switch ($id) {
        case 1:
            $categoriaName = "Sushi";
            break;
        case 2:
            $categoriaName = "Hamburger";
            break;
        case 3:
            $categoriaName = "Pizza";
            break;
        case 4:
            $categoriaName = "Soup";
            break;
        case 5:
            $categoriaName = "Barbecue";
            break;
        case 6:
            $categoriaName = "Healthy";
            break;
        case 7:
            $categoriaName = "Vegan";
            break;
        case 8:
            $categoriaName = "Indian";
            break;
        case 9:
            $categoriaName = "Thai";
            break;
        case 10:
            $categoriaName = "Chinese";
            break;
    }
    return $categoriaName;
}


function updateRestaurantCategory($id, $categoria, $db) {
    $stmt = $db->prepare("UPDATE restaurants set categoria='$categoria' WHERE id='$id';");
    $stmt->execute();
    session_start();
    $_SESSION["restaurant".$id]['categoria'] = $categoria;
}

function getIdForDish($db) {
    $counter = 1;
    $stmt = $db->prepare("SELECT nome FROM dishes;");
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$r) {
        return false;
    }
    else {
        foreach($r as $row => $elm) {
            $_SESSION["dish".$counter."numOfReviews"] = 0;
            $counter++;
        }
        return $counter;
    }
}

function createDish($db,$dName, $dDescription, $dPrice, $dCategory, $dRestaurantId) {
    $dishId = getIdForDish($db);
    $stmt = $db->prepare("INSERT INTO dishes(id, nome, preco, descricao, restaurantId, categoria, numberOfReviews, avgScore) VALUES (?,?,?,?,?,?,?,?);");
    $stmt->execute(array($dishId, $dName, $dPrice, $dDescription, $dRestaurantId, $dCategory, 0, 0));
    $stmtH = $db->prepare("INSERT INTO dishPriceHistory(dishId, price) VALUES (?,?);");
    $stmtH->execute(array($dishId, $dPrice));
    session_start();
    $string = $dRestaurantId."dish".$dishId;
    $_SESSION[$string]['set'] = true;
    $_SESSION[$string]['nome'] = $dName;
    $_SESSION[$string]['price'] = $dPrice;
    $_SESSION[$string]['category'] = $dCategory;
    $_SESSION[$string]['description'] = $dDescription;
    $_SESSION[$string]['restaurantAssoc'] = $dRestaurantId;
    $_SESSION[$string]['numOfReviews'] = 0;
    $_SESSION[$string]['avgScore'] = 0;
    $_SESSION[$restaurantId."dishes"]++;
    getNumOfDishesForRestaurant($db, $dRestaurantId);
    getNumOfAllDishes($db);
    getAllDishesInASession($db);
    getDishPriceHistory($dishId, $db);
    return $dishId;
}

function getNumOfDishesForRestaurant($db, $Rid) {
    $stmt = $db->prepare("SELECT count(*) FROM dishes where restaurantId = '$Rid';");
    $stmt->execute();
    $numero = $stmt->fetchColumn();
    session_start();
    $_SESSION[$Rid."dishes"] = $numero;
}

function setAllRestaurantDishesToZero($db) {
    $stmt = $db->prepare("SELECT count(*) FROM restaurants");
    $stmt->execute();
    $Allrestaurants = $stmt->fetchColumn();
    for ($a = 1; $a <= $Allrestaurants; $a++) {
        $_SESSION[$a."dishes"] = 0;
    }

}


function getNumOfAllRestaurantDishes($db) {
    $stmt = $db->prepare("SELECT * FROM dishes;");
    $stmt->execute();
    $AllDishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($AllDishes as $row => $dish) {
        $_SESSION[$dish['Rid']."dishes"]++;
    }
}

function getNumOfAllDishes($db) {
    $stmt = $db->prepare("SELECT count(*) FROM dishes;");
    $stmt->execute();
    $numeroD = $stmt->fetchColumn();
    $_SESSION["allDishes"] = $numeroD;
}


function getAllDishesInASession($db) {
    session_start();
    $stmt = $db->prepare("SELECT * FROM dishes;");
    $stmt->execute();
    $AllDishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $b = 1;
    foreach ($AllDishes as $row => $dish) {
        $_SESSION[$dish['restaurantId']."dish".$b] = $dish;
        $_SESSION[$dish['restaurantId']."dish".$b]['set'] = true;
        $b++;
    }
}


function insertReviewDish($dishId, $content, $rating, $db, $restaurantId) {
    session_start();
    $userId = $_SESSION["userid"];
    if (empty($userId)) {
        header("location: ../dish.php?id=$dishId&error=notLoggedIn");
    }
    else {
    $stmt = $db->prepare("INSERT INTO dishesReviews(dishId, score, conteudo, userId, restaurantId) VALUES ('$dishId', '$rating', '$content', '$userId', '$restaurantId');");
    $stmt->execute();
    $stmtTwo = $db->prepare("UPDATE users SET numOfReviews=numOfReviews+1 WHERE id = '$userId';");
    $stmtTwo->execute();
    $_SESSION["dish".$dishId."numberOfReviews"]++;
    $_SESSION["allDishReviews"]++;
    $number = $_SESSION["allDishReviews"];
    $string = $restaurantId."dishreview".$dishId."counter".$number;
    $_SESSION[$string]['exists'] = true;
    $_SESSION[$string]['user'] = $_SESSION[$userId."user"]['username'];
    $_SESSION[$string]["content"] = $content;
    $_SESSION[$string]["score"] = $rating;
    getReviewedDishes($userId, $db);
    if (getAvgScoreDish($dishId, $db, $restaurantId) === FALSE) {
        header("location: ../dish.php?id=$dishId&error=GettingAvg&r=$restaurantId");
        exit();
    }
    else if (getNumOfReviewsDish($dishId, $db, $restaurantId) === FALSE) {
        header("location: ../dish.php?id=$dishid&error=GettingNumOfReviews&r=$restaurantId");
        exit();
    }
    else if (getNumOfUserReviews($userId, $db) === FALSE) {
        header("location: ../dish.php?id=$dishid&error=GettingNumOfReviewsFromUser&r=$restaurantId");
        exit();
    }
    else {
        header("location: ../dish.php?id=$dishId&r=$restaurantId");
        exit();
    }
}
}

function getReviewedDishes($userId,$db) {
    $stmt = $db->prepare("SELECT * FROM dishesReviews WHERE userId='$userId';");
    $stmt->execute();
    $resultReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counter = 1;
    foreach($resultReviews as $row => $review) {
        $_SESSION[$counter."DreviewRestId"] = $review['restaurantId'];
        $_SESSION[$counter."Dreviewid"] = $review['dishId'];
        $_SESSION[$counter."Dreviewcontent"] = $review["conteudo"];
        $_SESSION[$counter."Dreviewscore"] = $review["score"];
        $counter++;
    }        
}

function getAllUsersInASession($db) {
    $stmt = $db->prepare("SELECT * FROM users;");
    $stmt->execute();
    $AllUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counter = 1;
    foreach ($AllUsers as $row => $user) {
        $_SESSION[$counter."user"] = $user;
        $stmtD = $db->prepare("SELECT count(*) FROM restaurants WHERE dono='$counter';");
        $stmtD->execute();
        $result = $stmtD->fetchColumn();
        if ($result>0) {
            $_SESSION[$counter."user"]["hasRestaurants"] = true;
        }
        else {
            $_SESSION[$counter."user"]["hasRestaurants"] = false;
        }
        $counter++;
    }
}

function getFavoriteDishes($userId, $db) {
    $stmt = $db->prepare("SELECT * FROM dishesFavorites WHERE userId = '$userId';");
    $stmt->execute();
    $resultFavorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultFavorites as $row => $restaurant) {
        $did = $restaurant['dishId'];
        $rid = $restaurant['restaurantId'];
        $string = $rid."dish".$did."favorite";
        $_SESSION[$string] = true;
    }
    return $resultFavorites;
}

function getAllDishReviewsInASession($db) {
    $stmt = $db->prepare("SELECT * FROM dishesReviews;");
    $stmt->execute();
    $AllReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counter = 0;
    foreach ($AllReviews as $row => $review) {
        $counter++;
        $_SESSION[$review['restaurantId']."dishreview".$counter] = $review;
        $_SESSION[$review['restaurantId']."dishreview".$counter]["exists"] = true;
        $_SESSION[$review['restaurantId']."dishreview".$counter]['user'] = $_SESSION[$review['userId']."user"]['username'];
    }
}

function getOwnedRestaurants($userId, $db) {
    session_start();
    $stmt = $db->prepare("SELECT * FROM restaurants WHERE dono='$userId';");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counter = 0;
    foreach ($result as $row => $ownedRestaurant) {
        $_SESSION["ownedRestaurant".$counter] = $ownedRestaurant;
        $counter++;
    }
    $_SESSION[$userId."ownedRestaurantNumber"] = $counter;
}

function emptyInputCreateDish($name, $description, $price, $category) {
    if (empty($name) || empty($description) || empty($price) || $category == "none") {
        return true;
    }
}


function invalidPrice($price) {
    return !is_numeric($price);
}

function getDishPriceHistory($dishId, $db)  {
    $stmt = $db->prepare("SELECT * FROM dishPriceHistory WHERE dishId = '$dishId';");
    $stmt->execute();
    $resultHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$resultHistory) {
        $_SESSION["dish".$dishId."totalNumberOfPrices"] = 0;
    } else {
    $counterD = 1;
    foreach ($resultHistory as $row => $priceTag) {
        $_SESSION["dish".$dishId."price".$counterD] = $priceTag['price'];
        $_SESSION["dish".$dishId."price".$counterD."time"] = $counterD;
        $counterD++;
    }
    $_SESSION["dish".$dishId."totalNumberOfPrices"] = $counterD; 
}
}

function deleteDish($dishId, $db) {
    $stmtC = $db->prepare("SELECT * FROM dishes WHERE id = '$dishId';");
    $stmtC->execute();
    $restaurantValue = $stmtC->fetchAll(PDO::FETCH_ASSOC);
    $restaurantIdForDish;
    foreach($restaurantValue as $row => $value) {
        $restaurantIdForDish = $value["restaurantId"];
    }
    $stmt = $db->prepare("DELETE FROM dishes WHERE id='$dishId';");
    $stmt->execute();
    $stmtA = $db->prepare("DELETE FROM dishPriceHistory WHERE dishId='$dishId';");
    $stmtA->execute();
    getAllDishesInASession($db);
    getNumOfAllDishes($db);
    getNumOfDishesForRestaurant($db, $restaurantIdForDish);
}

function insertResponseRest($reviewId, $conteudo, $restaurantId, $db) {
    $stmtR = $db->prepare("INSERT INTO reviewResponsesRest(reviewId, restaurantId ,conteudo) VALUES (?,?,?);");
    $stmtR->execute(array($reviewId, $restaurantId, $conteudo));
}

function getAllReviewResponsesRest($db) {
    $stmt = $db->prepare("SELECT * FROM restaurantReviews");
    $stmt->execute();
    $allRestReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($allRestReviews as $row => $reviewR)  {
        $id = $reviewR['id'];
        $stmtK = $db->prepare("SELECT * FROM reviewResponsesRest WHERE reviewId=$id;");
        $stmtK->execute();
        $allReviewsRespRest = $stmtK->fetchAll(PDO::FETCH_ASSOC);
        $counter = 1;
        foreach ($allReviewsRespRest as $row => $reviewResp) {
            session_start();
            $_SESSION[$reviewResp['restaurantId']."review".$id."responded"] = true;
            $_SESSION[$reviewResp['restaurantId']."review".$id."response".$counter] = $reviewResp;
        }
    }
}

function insertResponseDish($reviewId, $conteudo, $dishId, $restaurantId ,$db) {
    $stmtR = $db->prepare("INSERT INTO reviewResponsesDish(reviewId, dishId , restaurantId ,conteudo) VALUES (?,?,?,?);");
    $stmtR->execute(array($reviewId, $dishId, $restaurantId ,$conteudo));
}

function getAllReviewResponsesDish($db) {
    $stmt = $db->prepare("SELECT * FROM dishesReviews");
    $stmt->execute();
    $allRestReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($allRestReviews as $row => $reviewR)  {
        $id = $reviewR['id'];
        $stmtK = $db->prepare("SELECT * FROM reviewResponsesDish WHERE reviewId=$id;");
        $stmtK->execute();
        $allReviewsRespRest = $stmtK->fetchAll(PDO::FETCH_ASSOC);
        $counter = 1;
        foreach ($allReviewsRespRest as $row => $reviewResp) {
            session_start();
            $_SESSION[$reviewResp['restaurantId']."dishreview".$id."responded"] = true;
            $_SESSION[$reviewResp['restaurantId']."dishreview".$id."response".$counter] = $reviewResp;
        }
    }
}