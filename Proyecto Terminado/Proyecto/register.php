<?php
require 'CONEXION2.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Validar que coincidan las contraseñas
    if ($password !== $confirm) {
        exit("❌ Las contraseñas no coinciden.");
    }

    // Verificar si el usuario o correo ya existen
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        exit("❌ El usuario o el correo ya están registrados.");
    }

    // Hashear contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar usuario
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $passwordHash])) {
        echo "✅ Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "❌ Error al registrar: " . $errorInfo[2];
    }
}
?>

