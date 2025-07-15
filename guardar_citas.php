<?php
$servername = "sql206.infinityfree.com";
$username = "";
$password = "";
$dbname = "if0_38941782_farmacia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>