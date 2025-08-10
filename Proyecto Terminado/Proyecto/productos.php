<?php
session_start();
require 'CONEXION2.php';

// Verificar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Obtener productos desde la base de datos
try {
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener productos: " . $e->getMessage());
}

// Verificar si el usuario es administrador
$esAdmin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

// Inicializar arreglos para cantidades y totales
$cantidades = [];
$totales = [];

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cantidades'])) {
    $cantidades = $_POST['cantidades'];

    // Calcular totales para cada producto
    foreach ($productos as $producto) {
        $id = $producto['id'];
        $cantidad = isset($cantidades[$id]) ? (int)$cantidades[$id] : 0;
        $totales[$id] = $producto['precio'] * $cantidad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Tierra y Libertad</title>
    <style>
        body {
            background-color: #8B0000; /* color guindo */
            color: white; /* para mejor contraste con el fondo oscuro */
            font-family: Arial, sans-serif;
        }

        a {
            color: #FFD700; /* opcional: cambia el color de los enlaces */
        }

        header, nav, main, footer {
            margin: 20px;
        }

        table {
            color: white;
        }
    </style>
</head>
<body>
  <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
  <h3>Productos disponibles</h3>

  <?php if ($esAdmin): ?>
    <p><a href="agregar_producto.php">Agregar nuevo producto</a></p>
  <?php endif; ?>

  <form method="post" action="">
  <?php foreach ($productos as $producto): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
      <h4><?php echo htmlspecialchars($producto['nombre']); ?></h4>
      <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
      <strong>Precio unitario: $<?php echo number_format($producto['precio'], 2); ?></strong><br>

      <label for="cantidad_<?php echo $producto['id']; ?>">Cantidad:</label>
      <input type="number" id="cantidad_<?php echo $producto['id']; ?>" 
             name="cantidades[<?php echo $producto['id']; ?>]" min="0" 
             value="<?php echo isset($cantidades[$producto['id']]) ? htmlspecialchars($cantidades[$producto['id']]) : 0; ?>">

      <p>Total: $<?php echo isset($totales[$producto['id']]) ? number_format($totales[$producto['id']], 2) : '0.00'; ?></p>

      <?php if ($esAdmin): ?>
        <a href="editar_producto.php?id=<?php echo $producto['id']; ?>">Editar</a> |
        <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

  <input type="submit" value="Calcular totales">
  </form>

  <br>
  <a href="logout.php">Cerrar sesión</a>
</body>
</html>
