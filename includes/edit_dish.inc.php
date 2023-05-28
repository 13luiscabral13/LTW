<?php 
require_once 'dbh.inc.php';
require_once 'functions.inc.php';



if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $rid = $_GET["Ri"];
    $Name = $_POST["name"];
    $Description = $_POST["description"];
    $Price = $_POST["price"];
    $Categoria = $_POST["categories"];


    if (invalidPrice($Price)) {
        if ($_GET["e"] == "t") {
            header("location: ../edit_dish.php?id=$id&Ri=$rid&cr=y&e=t&error=invalidPrice");
            exit();
        }
        else {
            header("location: ../edit_dish.php?id=$id&Ri=$rid&cr=y&error=invalidPrice");
            exit();
        }
    }
    else if (emptyInputCreateDish($Name, $Description, $Price, $Categoria)) {
        if ($_GET["e"] == "t") {
            header("location: ../edit_dish.php?id=$id&Ri=$rid&cr=y&e=t&error=emptyinput");
            exit();
        }
        else {
            header("location: ../edit_dish.php?id=$id&Ri=$rid&cr=y&error=emptyinput");
            exit();
        }
    }

    $stmt = $db->prepare("UPDATE dishes SET nome=?, descricao=?, preco=?, categoria=? where id='$id';");
    $stmt->execute(array($Name, $Description, $Price, $Categoria));

    $stmtT = $db->prepare("INSERT INTO dishPriceHistory(dishId, Price) VALUES($id, $Price);");
    $stmtT->execute();

    getAllDishesInASession($db);
    getDishPriceHistory($id, $db);

    if ($_GET["e"] == "t") {
        header("location: ../add_restaurant_dishes.php?Ri=$rid&e=t");
        exit();
    }
    else {
        header("location: ../add_restaurant_dishes.php?Ri=$rid");
        exit();
    }
}