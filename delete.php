<?php

// Checks if the id parameter exists in the URL.
if(isset($_GET["id"])){
    $id = $_GET["id"];

    // Create Connection
    $pdo = "";
    include "database_connection.php";


    // Delete query
    $sql = "DELETE FROM clients WHERE id=$id";
    $pdo->query($sql);

}

header("location: /myshop/index.php");
exit;


?>