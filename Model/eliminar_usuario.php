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

// Inicializar variables
$id_usuario = null;
$mensaje = "";

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Validar que el ID es numérico
    if (filter_var($id_usuario, FILTER_VALIDATE_INT)) {
        // Verificar si se ha enviado la confirmación de eliminación
        if (isset($_GET['confirmar_eliminar']) && $_GET['confirmar_eliminar'] == 1) {
            // Preparar la consulta SQL
            $stmt = $conn->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            $stmt->bind_param("i", $id_usuario);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $mensaje = "El usuario ha sido eliminado correctamente.";
            } else {
                $mensaje = "Error al eliminar usuario: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $mensaje = "Confirmación no válida.";
        }
    } else {
        $mensaje = "ID de usuario no válido.";
    }
} else {
    $mensaje = "No se proporcionó un ID de usuario.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="../view/styles.css">
</head>
<body>
<?php
// Incluir el archivo HTML del modal y pasar la variable $id_usuario y $mensaje
include '../view/eliminar_usuario_modal.html';
?>
</body>
</html>
