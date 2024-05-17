import Swal from 'sweetalert2'

function redirectToEdit(clientId) {
    const encodedClient = btoa('client=' + clientId);
    const newUrl = '/clientes/add/' + encodedClient;
    window.location.href = newUrl;
}

function confirmDeletion(clientId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llamar a la función de eliminación en tu backend
            deleteClient(clientId);
        }
    })
}

function deleteClient(clientId) {
    // Obtener el formulario y el token CSRF
    let form = document.getElementById('deleteClientForm');
    let formData = new FormData(form);

    // Realizar la solicitud POST usando fetch
    fetch(`/clientes/delete/${clientId}`, {
            method: 'POST', // Método POST en lugar de DELETE
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'), // Token CSRF de Laravel para protección
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json()) // Convertir la respuesta a JSON
        .then(data => {
            // Manejar la respuesta
            if (data.success) {
                Swal.fire(
                    '¡Eliminado!',
                    'El cliente ha sido eliminado.',
                    'success'
                ).then(() => {
                    location.reload(); // Recargar la página después de eliminar exitosamente
                });
            } else {
                Swal.fire(
                    'Error',
                    'Hubo un problema al eliminar el cliente.',
                    'error'
                );
            }
        })
        .catch(error => {
            console.error('Error al eliminar el cliente:', error);
            Swal.fire(
                'Error',
                'Hubo un problema al eliminar el cliente.',
                'error'
            );
        });
}

// Obtener todos los elementos con la clase 'sendEdit'
var elementsEdit = document.getElementsByClassName('sendEdit');

// Iterar sobre cada elemento y agregar el evento click
for (var i = 0; i < elementsEdit.length; i++) {
    elementsEdit[i].addEventListener('click', function(event) {
        var element = event.currentTarget; // Usar currentTarget en lugar de target
        var name = element.getAttribute('data-name'); // Suponiendo que 'data-name' es el atributo que contiene el nombre
        if (name) {
            redirectToEdit(name);
        } else {
            console.error("No se encontró el atributo 'data-name' en el elemento.");
        }
    });
}

// Obtener todos los elementos con la clase 'sendDelete'
var elementsDelete = document.getElementsByClassName('sendDelete');

// Iterar sobre cada elemento y agregar el evento click
for (var i = 0; i < elementsDelete.length; i++) {
    elementsDelete[i].addEventListener('click', function(event) {
        var element = event.currentTarget; // Usar currentTarget en lugar de target
        var name = element.getAttribute('data-name'); // Suponiendo que 'data-name' es el atributo que contiene el nombre
        if (name) {
            confirmDeletion(name);
        } else {
            console.error("No se encontró el atributo 'data-name' en el elemento.");
        }
    });
}