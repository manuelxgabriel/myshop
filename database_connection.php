<?php

// Create and load environment variables
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Define the database connection type (MySQL)
$type = 'mysql';

// Retrieve database connection details from environment variables
$servername = $_ENV['DB_HOST']; // Database server hostname
$database = $_ENV['DB_NAME'];   // Name of the database
$port = $_ENV['DB_PORT'];       // Database port
$username = $_ENV['DB_USER'];   // Database username
$password = $_ENV['DB_PASS'];   // Database password
$charset = "utf8mb4";

// Establish a new PDO connection
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