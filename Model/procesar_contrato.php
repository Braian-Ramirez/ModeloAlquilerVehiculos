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
$numero_identificacion = $_POST['numero_identificacion'];
$placa = $_POST['placa'];
$serial_contrato = $_POST['serial_contrato'];

// Calcular la diferencia en días entre las fechas de inicio y final
$fecha_inicio_dt = new DateTime($fecha_inicio);
$fecha_final_dt = new DateTime($fecha_final);
$diferencia_dias = $fecha_final_dt->diff($fecha_inicio_dt)->days;

// Determinar el tipo de vehículo y calcular el precio
$sql_vehiculo = "SELECT tipo_vehiculo FROM vehiculo WHERE id_vehiculo = ?";
$stmt_vehiculo = $conn->prepare($sql_vehiculo);
$stmt_vehiculo->bind_param("i", $id_vehiculo);
$stmt_vehiculo->execute();
$stmt_vehiculo->bind_result($tipo_vehiculo);
$stmt_vehiculo->fetch();
$stmt_vehiculo->close();

if ($tipo_vehiculo == 'moto') {
    $precio_por_dia = 50000;
} elseif ($tipo_vehiculo == 'carro') {
    $precio_por_dia = 80000;
} else {
    die("Error: Tipo de vehículo no válido.");
}

$precio = $diferencia_dias * $precio_por_dia;

// Insertar contrato en la base de datos
$sql = "INSERT INTO contrato (nombre, numero_identificacion, placa, observaciones, fecha_inicio, fecha_final, id_usuario, id_vehiculo, precio, serial_contrato)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("ssssssisis", $nombre, $numero_identificacion, $placa, $observaciones, $fecha_inicio, $fecha_final, $id_usuario, $id_vehiculo, $precio, $serial_contrato);

if ($stmt->execute()) {
    // Redirigir a crear_contrato.php con los datos necesarios para mostrar en el modal
    header("Location: ../View/crear_contrato.php?success=1&placa=$placa&dias=$diferencia_dias&precio=$precio");
    exit();
} else {
    echo "Error al crear el contrato: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
