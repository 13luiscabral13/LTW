<?php

try {

$db = new PDO('sqlite:../mainDB.db');

}

catch(PDOException $e) {
    echo $e->getMessage();
}
?>
