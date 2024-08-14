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
$id_vehiculo = $_POST['id_vehiculo'];
$placa = $_POST['placa'];
$soat = $_POST['soat'];
$tipo_vehiculo = $_POST['tipo_vehiculo'];
$tecno_mecanica = $_POST['tecno_mecanica'];
$clase_vehiculo = $_POST['clase_vehiculo'];

// Consulta SQL para actualizar los datos del vehículo
$sql = "UPDATE vehiculo SET 
            placa = '$placa', 
            soat = '$soat', 
            tipo_vehiculo = '$tipo_vehiculo', 
            tecno_mecanica = '$tecno_mecanica', 
            clase_vehiculo = '$clase_vehiculo' 
        WHERE id_vehiculo = '$id_vehiculo'";

if ($conn->query($sql) === TRUE) {
    $message = "Vehículo actualizado correctamente";
} else {
    $message = "Error al actualizar el vehículo: " . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir a modificar_vehiculo.html con el mensaje en la URL
header("Location: ../view/modificar_vehiculo.php?message=" . urlencode($message));
exit();
?>
