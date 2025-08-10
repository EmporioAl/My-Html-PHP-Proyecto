<?php
include 'CONEXION.php';

$action = $_POST['action'];
$id = $_POST['id'];
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$Correo = $_POST['Correo'];
$Telefono = $_POST['Telefono'];
$fechaHora = $_POST['fecha_Hora'];
$fechaHora = str_replace("T", " ", $fechaHora);

switch ($action) {
    case 'add':
        $stmt = $conn->prepare("INSERT INTO Citas (NOMBRE, APELLIDO, CORREO, TELEFONO, FECHA_HORA) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Nombre, $Apellido, $Correo, $Telefono, $fechaHora);
        $stmt->execute();
        // Opcional: verifica si la inserción fue exitosa para cambiar el mensaje
        if ($stmt->affected_rows > 0) {
            $mensaje = "¡Cita agendada correctamente!";
        } else {
            $mensaje = "Error al agendar la cita. Intente nuevamente.";
        }
        $stmt->close();
        break;
}

// Redirigir a Citas.php con el mensaje
header("Location: Citas.php?mensaje=" . urlencode($mensaje));
exit();
?>
