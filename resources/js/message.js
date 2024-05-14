import Swal from 'sweetalert2'

// Función para mostrar mensajes de éxito o error
function showMessages() {
    // Obtener los datos de éxito y error del cuerpo del documento
    const successMessage = document.body.getAttribute('data-success');
    const errorMessage = document.body.getAttribute('data-error');

    // Verificar si existe un mensaje de éxito
    if (successMessage) {
        // Mostrar mensaje de éxito
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: successMessage
        });
    }

    // Verificar si existe un mensaje de error
    if (errorMessage) {
        // Mostrar mensaje de error
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
        });
    }
}

// Ejecutar la función al cargar la página
window.addEventListener('DOMContentLoaded', () => {
    showMessages();
});