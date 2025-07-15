<?php
include 'guardar_citas.php';

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
        break;
    case 'update':
        $stmt = $conn->prepare("UPDATE Citas SET NOMBRE = ?, APELLIDO = ?, CORREO = ?, TELEFONO = ?, FECHA_HORA = ?, WHERE ID = ?");
        $stmt->bind_param("sssssi", $Nombre, $Apellido, $Correo, $Telefono, $fechaHora, $id);
        $stmt->execute();
        break;
    case 'delete':
        $stmt = $conn->prepare("DELETE FROM Citas WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        break;
}

header("Location: Citas.html");
?>
