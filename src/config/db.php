<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, "/../");
$dotenv->load();
$host = 'localhost';
$dbname = getenv("MYSQL_DB");
$username = getenv("MYSQL_USERNAME");
$password = getenv("MYSQL_PASSWORD");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
