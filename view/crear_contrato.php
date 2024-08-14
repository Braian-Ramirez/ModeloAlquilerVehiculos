<?php
// Obtener los datos de la URL (GET)
$nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '';
$numero_identificacion = isset($_GET['numero_identificacion']) ? htmlspecialchars($_GET['numero_identificacion']) : '';
$placa = isset($_GET['placa']) ? htmlspecialchars($_GET['placa']) : '';
$id_usuario = isset($_GET['id_usuario']) ? htmlspecialchars($_GET['id_usuario']) : '';
$id_vehiculo = isset($_GET['id_vehiculo']) ? htmlspecialchars($_GET['id_vehiculo']) : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Contrato</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="crear_contratostyles.css">
    <style>
    </style>
</head>
<body>
<div class="container">
    <h2>Crear Contrato</h2>
    <form action="../Model/procesar_contrato.php" method="post"> <!-- Archivo para procesar los datos del contrato -->
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="numero_identificacion">Número de Identificación:</label>
            <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" value="<?php echo $numero_identificacion; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="placa">Placa del Vehículo:</label>
            <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $placa; ?>" readonly>
        </div>
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input type="hidden" name="id_vehiculo" value="<?php echo $id_vehiculo; ?>">
        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
        </div>
        <div class="form-group">
            <label for="fecha_final">Fecha Final:</label>
            <input type="date" class="form-control" id="fecha_final" name="fecha_final">
        </div>
        <div class="form-group">
            <label for="serial_contrato">Serial Contrato:</label>
            <input type="text" class="form-control" id="serial_contrato" name="serial_contrato">
        </div>
        <button type="submit" class="btn btn-custom">Crear Contrato</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Contrato Creado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    Contrato creado exitosamente. Su alquiler del vehículo con placa <?php echo htmlspecialchars($_GET['placa']); ?> por <?php echo htmlspecialchars($_GET['dias']); ?> días es de $<?php echo number_format($_GET['precio']); ?> COP.
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="../View/index.html" class="btn btn-secondary">Cerrar</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Mostrar el modal si se recibió una respuesta exitosa
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        $('#successModal').modal('show');
        <?php endif; ?>
    });
</script>
</body>
</html>
