//Inicio JavaScript index.html
document.addEventListener('DOMContentLoaded', function () {
    var myCarousel = document.querySelector('#carouselExampleIndicators');
    var carousel = new bootstrap.Carousel(myCarousel);
});
src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
src="https://code.jquery.com/jquery-3.5.1.slim.min.js"

// Mostrar el modal basado en el parámetro de la URL
window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const registro = urlParams.get('registro');
    const modal = document.getElementById('modalResultado');
    const modalMensaje = document.getElementById('modalMensaje');

    if (registro) {
        if (registro === 'exitoso') {
            modalMensaje.textContent = 'El registro del arrendatario fue exitoso.';
        } else if (registro === 'error') {
            modalMensaje.textContent = 'Error al registrar al arrendatario.';
        }
        modal.style.display = 'block';
    }
};

// fin JavaScript index.html
// Inicio JavaScript modal
// Función para cerrar el modal
function cerrarModal() {
    document.getElementById('modalResultado').style.display = 'none';
}

// Cerrar modal si se hace clic fuera del contenido
window.onclick = function (event) {
    const modal = document.getElementById('modalResultado');
    if (event.target === modal) {
        cerrarModal();
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registroForm');
    const modal = document.getElementById('modalResultado');
    const modalMessage = document.getElementById('modalMensaje');

    // Función para mostrar el modal con un mensaje
    function mostrarModal(mensaje) {
        modalMessage.textContent = mensaje;
        modal.style.display = 'flex';
    }

    // Función para cerrar el modal
    function cerrarModal() {
        modal.style.display = 'none';
    }

    // Evento para cerrar el modal al hacer clic en el botón de cerrar
    document.querySelector('.modal-close').addEventListener('click', cerrarModal);

    // Manejar el envío del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario para pruebas

        // Aquí podrías agregar lógica para procesar el formulario.
        // Por ejemplo, hacer una solicitud AJAX al servidor para registrar los datos.

        // Simular un registro exitoso y mostrar el modal
        mostrarModal('¡Registro exitoso!');

        // Si deseas enviar el formulario después de mostrar el modal, descomenta la siguiente línea:
        // form.submit();
    });
});
