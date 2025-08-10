<?php

$host = "sql206.infinityfree.com";     
$usuario = "";     
$contrasena = ""; 
$base_de_datos = "";

// Crear la conexión usando mysqli
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$comentario = $_POST['comentario'] ?? '';

// Validar que no estén vacíos
if (empty($nombre) || empty($correo) || empty($comentario)) {
    die("Todos los campos son obligatorios.");
}

// Preparar la consulta SQL segura
$stmt = $conn->prepare("INSERT INTO contacto (nombre, correo, comentario) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $correo, $comentario);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Gracias por su comentario!, puede regresar a la página.";
} else {
    echo "Error al guardar el comentario.: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();

?>
