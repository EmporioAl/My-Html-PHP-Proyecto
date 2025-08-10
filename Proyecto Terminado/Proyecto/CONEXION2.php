<?php
$host = "sql206.infinityfree.com";
$db = "";
$user = "";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Conexión exitosa"; // descomenta para verificar si todo va bien
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
