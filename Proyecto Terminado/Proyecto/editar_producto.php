<?php
session_start();
require 'CONEXION2.php';

// Solo admins pueden acceder
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.html");
    exit();
}

$mensaje = '';

if (!isset($_GET['id'])) {
    header("Location: productos.php");
    exit();
}

$id = intval($_GET['id']);

// Obtener producto
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

if (!$producto) {
    echo "Producto no encontrado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);

    if ($nombre === '' || $precio <= 0) {
        $mensaje = "El nombre y el precio son obligatorios y el precio debe ser mayor a cero.";
    } else {
        $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?");
        if ($stmt->execute([$nombre, $descripcion, $precio, $id])) {
            $mensaje = "Producto actualizado correctamente.";
            // Refrescar datos para mostrar actualizados
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            $producto = $stmt->fetch();
        } else {
            $mensaje = "Error al actualizar el producto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar producto</h2>

    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form action="editar_producto.php?id=<?php echo $producto['id']; ?>" method="POST">
        <input type="text" name="nombre" placeholder="Nombre del producto" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required><br><br>
        <textarea name="descripcion" placeholder="Descripción" rows="4" cols="40"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br><br>
        <input type="number" step="0.01" name="precio" placeholder="Precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required><br><br>
        <button type="submit">Actualizar Producto</button>
    </form>

    <br>
    <a href="productos.php">Volver a productos</a>
</body>
</html>
