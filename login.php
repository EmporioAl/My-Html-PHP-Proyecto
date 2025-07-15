<?php
$host = "sql206.infinityfree.com";
$user = "";
$pass = "";
$db = "if0_38941782_farmacia";

// Conectar a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta (sin protección contra inyección SQL aún)
$sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "¡Login exitoso! Bienvenido, $username.";
} else {
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>
