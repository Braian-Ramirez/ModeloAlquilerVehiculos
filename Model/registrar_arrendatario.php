<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrienda_vehiculo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer la codificación de caracteres a UTF-8
$conn->set_charset("utf8");

// Recoger datos del formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null;
$numero_identificacion = isset($_POST['numero_identificacion']) ? $_POST['numero_identificacion'] : null;
$ciudad_residencia = isset($_POST['ciudad_residencia']) ? $_POST['ciudad_residencia'] : null;
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

// Verificar que se recibieron todos los datos
if (!$nombre || !$correo || !$fecha_nacimiento || !$numero_identificacion || !$ciudad_residencia || !$direccion || !$telefono) {
    header("Location: ../view/registro_arrendatario.html?registro=error");
    exit();
}

// Preparar la consulta SQL
$sql = "INSERT INTO usuario (nombre, correo, fecha_nacimiento, numero_identificacion, ciudad_residencia, direccion, telefono) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . htmlspecialchars($conn->error));
}

// Vincular los parámetros
$stmt->bind_param("sssssss", $nombre, $correo, $fecha_nacimiento, $numero_identificacion, $ciudad_residencia, $direccion, $telefono);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    header("Location: ../view/registro_arrendatario.html?registro=exitoso");
} else {
    header("Location: ../view/registro_arrendatario.html?registro=error");
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>
