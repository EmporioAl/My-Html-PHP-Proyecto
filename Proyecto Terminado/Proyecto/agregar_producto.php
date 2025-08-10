<?php
session_start();
require 'CONEXION2.php';

// Solo admins pueden acceder
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.html");
    exit();
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);

    if ($nombre === '' || $precio <= 0) {
        $mensaje = "El nombre y el precio son obligatorios y el precio debe ser mayor a cero.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
        if ($stmt->execute([$nombre, $descripcion, $precio])) {
            $mensaje = "Producto agregado correctamente.";
        } else {
            $mensaje = "Error al agregar el producto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar nuevo producto</h2>
    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form action="agregar_producto.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre del producto" required><br><br>
        <textarea name="descripcion" placeholder="Descripción" rows="4" cols="40"></textarea><br><br>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required><br><br>
        <button type="submit">Agregar Producto</button>
    </form>
    <br>
    <a href="productos.php">Volver a productos</a>
</body>
</html>
