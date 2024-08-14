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
$numero_identificacion = $_POST['numero_identificacion'];
$placa = $_POST['placa'];

// Consultar información del usuario
$sql_usuario = "SELECT nombre, id_usuario FROM usuario WHERE numero_identificacion = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $numero_identificacion);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();

// Consultar información del vehículo
$sql_vehiculo = "SELECT id_vehiculo FROM vehiculo WHERE placa = ?";
$stmt_vehiculo = $conn->prepare($sql_vehiculo);
$stmt_vehiculo->bind_param("s", $placa);
$stmt_vehiculo->execute();
$result_vehiculo = $stmt_vehiculo->get_result();

// Redirigir a crear_contrato.html con parámetros en la URL
if ($result_usuario->num_rows > 0 && $result_vehiculo->num_rows > 0) {
    $usuario = $result_usuario->fetch_assoc();
    $vehiculo = $result_vehiculo->fetch_assoc();
    header("Location: ../view/crear_contrato.php?nombre=" . urlencode($usuario['nombre']) .
        "&numero_identificacion=" . urlencode($numero_identificacion) .
        "&placa=" . urlencode($placa) .
        "&id_usuario=" . urlencode($usuario['id_usuario']) .
        "&id_vehiculo=" . urlencode($vehiculo['id_vehiculo']));
    exit();
} else {
    echo "No se encontraron resultados.<br>";
}

// Cerrar conexión
$stmt_usuario->close();
$stmt_vehiculo->close();
$conn->close();
?>
