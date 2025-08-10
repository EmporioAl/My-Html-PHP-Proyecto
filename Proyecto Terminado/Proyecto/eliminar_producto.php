<?php
session_start();
require 'CONEXION2.php';

// Solo admins pueden acceder
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.html");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: productos.php");
    exit();
}

$id = intval($_GET['id']);

// Eliminar producto
$stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
if ($stmt->execute([$id])) {
    // Redirigir con mensaje opcional
    header("Location: productos.php?mensaje=Producto eliminado correctamente");
} else {
    header("Location: productos.php?mensaje=Error al eliminar el producto");
}
exit();
