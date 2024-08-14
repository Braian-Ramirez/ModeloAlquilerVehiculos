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

// Escapar los datos del formulario para evitar inyecciones SQL
$placa = $conn->real_escape_string($_POST['placa']);
$soat = $conn->real_escape_string($_POST['soat']);
$tipo_vehiculo = $conn->real_escape_string($_POST['tipo_vehiculo']);
$tecno_mecanica = $conn->real_escape_string($_POST['tecno_mecanica']);
$clase_vehiculo = $conn->real_escape_string($_POST['clase_vehiculo']);

// Consulta SQL para insertar los datos
$sql = "INSERT INTO vehiculo (placa, soat, tipo_vehiculo, tecno_mecanica, clase_vehiculo) 
        VALUES ('$placa', '$soat', '$tipo_vehiculo', '$tecno_mecanica', '$clase_vehiculo')";

// Ejecutar la consulta y verificar el resultado
if ($conn->query($sql) === TRUE) {
    header("Location: ../view/registrar_vehiculo.html?status=success");
} else {
    header("Location: ../view/registrar_vehiculo.html?status=error");
}

// Cerrar conexión
$conn->close();
exit();
?>
