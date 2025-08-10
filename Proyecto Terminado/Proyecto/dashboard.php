<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // El usuario no ha iniciado sesión
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
</head>
<body>
  <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> </h2>
  <p>Has accedido a una página protegida.</p>
  <a href="logout.php">Cerrar sesión</a>
</body>
</html>
