<?php
session_start();

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

// Inicializar variables
$id_vehiculo = null;
$mensaje = "";

// Verificar si se ha proporcionado un ID de vehículo válido
if (isset($_POST['id_vehiculo'])) {
    $id_vehiculo = $_POST['id_vehiculo'];

    // Validar que el ID es numérico
    if (filter_var($id_vehiculo, FILTER_VALIDATE_INT)) {
        // Preparar la consulta SQL para eliminar el vehículo
        $stmt = $conn->prepare("DELETE FROM vehiculo WHERE id_vehiculo = ?");
        $stmt->bind_param("i", $id_vehiculo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "El vehículo ha sido eliminado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar el vehículo: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['mensaje'] = "ID de vehículo no válido.";
    }
} else {
    $_SESSION['mensaje'] = "No se proporcionó un ID de vehículo.";
}

$conn->close();

// Redirigir al archivo HTML que mostrará el modal
header("Location: ../view/eliminar_vehiculo.html");
exit();
?>
