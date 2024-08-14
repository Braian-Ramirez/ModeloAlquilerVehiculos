<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrienda_vehiculo";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica para buscar el usuario por número de identificación
if (isset($_GET['identificacion'])) {
    $identificacion = $conn->real_escape_string($_GET['identificacion']);
    $query = "SELECT * FROM usuario WHERE numero_identificacion = '$identificacion'";
    $result = $conn->query($query);
    $usuario = $result->fetch_assoc();
}

$conn->close();

// Incluir el archivo de presentación después de haber definido la variable $usuario
include '../view/gestion_usuario_form.html';
