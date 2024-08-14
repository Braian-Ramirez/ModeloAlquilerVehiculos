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

// Inicializar variables para almacenar los datos del usuario
$id_usuario = $nombre = $correo = $fecha_nacimiento = $numero_identificacion = $ciudad_residencia = $direccion = $telefono = "";

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Obtener los datos del usuario desde la base de datos
    $query = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
    $result = $conn->query($query);

    if (!$result) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        $nombre = $usuario['nombre'];
        $correo = $usuario['correo'];
        $fecha_nacimiento = $usuario['fecha_nacimiento'];
        $numero_identificacion = $usuario['numero_identificacion'];
        $ciudad_residencia = $usuario['ciudad_residencia'];
        $direccion = $usuario['direccion'];
        $telefono = $usuario['telefono'];
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
}

// Procesar los datos actualizados del formulario
$actualizacion_exitosa = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $numero_identificacion = $_POST['numero_identificacion'];
    $ciudad_residencia = $_POST['ciudad_residencia'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Actualizar los datos del usuario en la base de datos
    $query = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', fecha_nacimiento = '$fecha_nacimiento', ciudad_residencia = '$ciudad_residencia', direccion = '$direccion', telefono = '$telefono' WHERE id_usuario = '$id_usuario'";

    if ($conn->query($query) === TRUE) {
        $actualizacion_exitosa = true;
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
}

// Incluir el formulario de edición
include '../view/editar_usuario_form.html';

$conn->close();
?>
