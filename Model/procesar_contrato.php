<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrienda_vehiculo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$id_vehiculo = $_POST['id_vehiculo'];
$observaciones = $_POST['observaciones'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

// Insertar contrato en la base de datos
$sql = "INSERT INTO contrato (nombre, numero_identificacion, placa, observaciones, fecha_inicio, fecha_final, id_usuario, id_vehiculo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("ssssssis", $nombre, $numero_identificacion, $placa, $observaciones, $fecha_inicio, $fecha_final, $id_usuario, $id_vehiculo);

$numero_identificacion = $_POST['numero_identificacion'];
$placa = $_POST['placa'];

if ($stmt->execute()) {
    echo "Contrato creado exitosamente.";
} else {
    echo "Error al crear el contrato: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
