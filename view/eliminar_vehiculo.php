<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Vehículo</title>
    <link rel="stylesheet" href="../view/eliminacion_styles.css">
</head>
<body>
<?php
// Obtener los datos enviados por POST
$id_vehiculo = $_POST['id_vehiculo'];
$placa = $_POST['placa'];
?>

<!-- Modal para confirmación -->
<div id="modalConfirmacion" class="modal">
    <div class="modal-content">
        <h2>Confirmar Eliminación del Vehículo</h2>
        <p>¿Está seguro de que desea eliminar el vehículo con la placa <strong><?php echo htmlspecialchars($placa, ENT_QUOTES); ?></strong>?</p>
        <button class="modal-btn" onclick="confirmarEliminacion()">Sí, Eliminar</button>
        <button class="modal-btn cancel" onclick="cancelarEliminacion()">Cancelar</button>
    </div>
</div>

<!-- Modal para el resultado -->
<div id="modalResultado" class="modal">
    <div class="modal-content">
        <p id="resultadoMensaje"></p>
        <button class="modal-btn" onclick="cerrarModalResultado()">Cerrar</button>
    </div>
</div>

<!-- Script para manejar los modales -->
<script>
    var id_vehiculo = "<?php echo isset($id_vehiculo) ? htmlspecialchars($id_vehiculo) : ''; ?>";

    function cerrarModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    function mostrarModal(id) {
        document.getElementById(id).style.display = 'block';
    }

    function confirmarEliminacion() {
        if (id_vehiculo) {
            // Cierra el modal de confirmación
            cerrarModal('modalConfirmacion');

            // Realiza la petición para eliminar el vehículo
            fetch('../Model/eliminar_vehiculo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_vehiculo=' + encodeURIComponent(id_vehiculo)
            })
                .then(response => response.text())
                .then(data => {
                    // Mostrar el segundo modal con el mensaje correspondiente
                    document.getElementById('resultadoMensaje').textContent = data.includes('El vehículo ha sido eliminado correctamente.')
                        ? 'El vehículo ha sido eliminado correctamente.'
                        : 'Hubo un error al eliminar el vehículo.';
                    mostrarModal('modalResultado');
                })
                .catch(error => {
                    document.getElementById('resultadoMensaje').textContent = 'Hubo un error al eliminar el vehículo.';
                    mostrarModal('modalResultado');
                });
        } else {
            alert('No se proporcionó un ID de vehículo válido.');
        }
    }

    function cerrarModalResultado() {
        cerrarModal('modalResultado');
        // Redirige a la página de búsqueda después de cerrar el modal de resultado
        window.location.href = '../view/buscar_vehiculo.html';
    }

    // Mostrar el modal de confirmación al cargar la página
    window.onload = function() {
        mostrarModal('modalConfirmacion');
    }

    function cancelarEliminacion() {
        // Redirige a la página de búsqueda al hacer clic en "Cancelar"
        window.location.href = '../view/buscar_vehiculo.html';
    }
</script>
</body>
</html>
