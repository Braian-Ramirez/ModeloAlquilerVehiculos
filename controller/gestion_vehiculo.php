<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Vehículo</title>
    <link rel="stylesheet" href="../view/datos_vehiculostyles.css">
    <style>
        /* Estilo para alinear los botones lado a lado */
        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px; /* Espacio entre los botones */
            margin-top: 10px; /* Espacio superior para los botones */
        }
        .button-container input[type="submit"] {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            background-color: #4CAF50; /* Color de fondo para el botón Modificar */
            color: white;
            border-radius: 5px;
        }
        .button-container form:last-child input[type="submit"] {
            background-color: #f44336; /* Color de fondo para el botón Eliminar */
        }
    </style>
</head>
<body>
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

// Obtener la placa del formulario
$placa = $_POST['placa'];

// Consulta SQL para buscar el vehículo por su placa
$sql = "SELECT * FROM vehiculo WHERE placa = '$placa'";
$result = $conn->query($sql);

// Verificar si se encontró el vehículo
if ($result->num_rows > 0) {
    // Obtener los datos del vehículo
    $row = $result->fetch_assoc();

    if (isset($row['id_vehiculo'])) {
        $id_vehiculo = $row['id_vehiculo'];
    } else {
        die("Error: El campo 'id_vehiculo' no existe en la tabla.");
    }

    // Mostrar la información del vehículo con un formulario para modificar
    echo "<form action='../Model/modificar_vehiculo.php' method='post'>";
    echo "<h2>Información del Vehículo</h2>";
    echo "Placa: <input type='text' name='placa' value='" . htmlspecialchars($row['placa'], ENT_QUOTES) . "' required><br>";
    echo "<input type='hidden' name='id_vehiculo' value='" . htmlspecialchars($id_vehiculo, ENT_QUOTES) . "'>";
    echo "SOAT: <input type='text' name='soat' value='" . htmlspecialchars($row['soat'], ENT_QUOTES) . "' required><br>";
    echo "Tipo de Vehículo:
            <select name='tipo_vehiculo' required>
                <option value='moto'" . ($row['tipo_vehiculo'] == 'moto' ? ' selected' : '') . ">Moto</option>
                <option value='carro'" . ($row['tipo_vehiculo'] == 'carro' ? ' selected' : '') . ">Carro</option>
            </select><br>";
    echo "Tecno-Mecánica:
            <select name='tecno_mecanica' required>
                <option value='vigente'" . ($row['tecno_mecanica'] == 'vigente' ? ' selected' : '') . ">Vigente</option>
                <option value='no_vigente'" . ($row['tecno_mecanica'] == 'no_vigente' ? ' selected' : '') . ">No vigente</option>
            </select><br>";
    echo "Clase de Vehículo:
            <select name='clase_vehiculo' required>
                <option value='electrico'" . ($row['clase_vehiculo'] == 'electrico' ? ' selected' : '') . ">Eléctrico</option>
                <option value='gasolina'" . ($row['clase_vehiculo'] == 'gasolina' ? ' selected' : '') . ">Gasolina</option>
            </select><br>";

    // Botón de modificar dentro de su propio formulario
    echo "<div class='button-container'>";
    echo "<input type='submit' value='Modificar'>";
    echo "</div>"; // Cierre del contenedor de botones
    echo "</form>";

    // Formulario separado para eliminar el vehículo, redirigiendo a eliminar_vehiculo.php
    echo "<form action='../view/eliminar_vehiculo.php' method='post'>";
    echo "<div class='button-container'>";
    echo "<input type='hidden' name='id_vehiculo' value='" . htmlspecialchars($id_vehiculo, ENT_QUOTES) . "'>";
    echo "<input type='hidden' name='placa' value='" . htmlspecialchars($row['placa'], ENT_QUOTES) . "'>";
    echo "<input type='submit' value='Eliminar'>";
    echo "</div>"; // Cierre del contenedor de botones
    echo "</form>";

} else {
    echo "No se encontró un vehículo con la placa: $placa";
}

$conn->close();
?>
</body>
</html>
