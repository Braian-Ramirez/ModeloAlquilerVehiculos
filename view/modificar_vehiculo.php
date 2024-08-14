<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Vehículo</title>
    <link rel="stylesheet" href="../view/modificar_vehiculostyles.css">

</head>
<body>
<!-- Modal de confirmación -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalMessage"></p>
        <a href="../view/buscar_vehiculo.html" class="button">Cerrar</a>
    </div>
</div>

<script>
    // Función para mostrar el modal
    function showModal(message) {
        var modal = document.getElementById("confirmationModal");
        var modalMessage = document.getElementById("modalMessage");

        modalMessage.textContent = message;
        modal.style.display = "block";
    }

    // Obtener el mensaje de la URL y mostrar el modal
    var urlParams = new URLSearchParams(window.location.search);
    var message = urlParams.get('message');
    if (message) {
        showModal(decodeURIComponent(message));
    }

    // Cerrar el modal
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        window.location.href = "../view/buscar_vehiculo.html";
    }

    // Cerrar el modal cuando se hace clic fuera de él
    window.onclick = function(event) {
        var modal = document.getElementById("confirmationModal");
        if (event.target == modal) {
            window.location.href = "../view/buscar_vehiculo.html";
        }
    }
</script>

</body>
</html>
