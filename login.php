<?php
session_start();
require 'CONEXION2.php';

// Activar errores para depurar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];

    // Buscar al usuario por username o email
    $stmt = $pdo->prepare("SELECT id, username, email, password_hash, rol FROM users WHERE username = ? OR email = ?");
    // ERROR introducido: puse solo una variable en execute() cuando deberían ser dos
    $stmt->execute([$usernameOrEmail]); 
    $user = $stmt->fetch();

    if ($user) {
        // Verificar la contraseña
        if (password_verify($password, $user['password_hash'])) {
            // Iniciar sesión y guardar datos
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['rol'] = $user['rol']; // Puede ser 'admin' o 'user'

            // Redirigir al catálogo de productos
            header("Location: productos.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario o correo no encontrado.";
    }
}
?>
