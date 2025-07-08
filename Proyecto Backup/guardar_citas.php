<?php
$servername = "sql206.infinityfree.com";
$username = "if0_38941782";
$password = "N1fZpyEKe0e";
$dbname = "if0_38941782_farmacia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>