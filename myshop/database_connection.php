<?php
$type = 'mysql';
$servername = "localhost";
$database = "myshop";
$port = "3306";
$charset = "utf8mb4";
$username = "root";
$password = "root";

// Create connection
try {
    $dsn = "$type:host=$servername;dbname=$database;port=$port;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);


} catch (PDOException $e) {
    throw new PDOException($e->getMessage());
}

?>