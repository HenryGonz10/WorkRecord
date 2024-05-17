import Swal from 'sweetalert2';
document.getElementById('search-button').addEventListener('click', function() {
    Swal.fire({
        title: 'Buscar',
        input: 'text',
        inputPlaceholder: 'Escribe algo para buscar',
        showCancelButton: true,
        confirmButtonText: 'Buscar',
        preConfirm: function(searchTerm) {
            return fetch(`/company/search`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ term: searchTerm })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(`La búsqueda falló: ${error}`);
                });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then(result => {
        if (result.isConfirmed) {
            const companys = result.value;

            if (companys.length > 1) {
                let options = {};
                companys.forEach((company, index) => {
                    options[index] = `${company.nombre} - ${company.cif}`;
                });

                Swal.fire({
                    title: 'Seleccione una empresa',
                    input: 'select',
                    inputOptions: options,
                    inputPlaceholder: 'Seleccione una empresa',
                    showCancelButton: true,
                    confirmButtonText: 'Seleccionar',
                    preConfirm: (selection) => {
                        if (!selection) {
                            Swal.showValidationMessage('Debe seleccionar una opción válida');
                        }
                        return selection;
                    }
                }).then(selection => {
                    if (selection.isConfirmed && selection.value) {
                        const selectedcompany = companys[selection.value];
                        history.pushState(null, '', '/clientes/add/' + btoa('company=' + selectedcompany.id));
                        document.getElementById('empresa_id').value = selectedcompany.id;
                        document.getElementById('cif').value = selectedcompany.cif;
                        document.getElementById('nombre').value = selectedcompany.nombre;
                        document.getElementById('domicilio').value = selectedcompany.domicilio;
                        document.getElementById('telefono').value = selectedcompany.telefono;
                        document.getElementById('email').value = selectedcompany.email;
                        document.getElementById('web').value = selectedcompany.web;
                    }
                });

            } else if (companys.length === 1) {
                const company = companys[0];
                history.pushState(null, '', '/clientes/add/' + btoa('company=' + company.id));
                document.getElementById('empresa_id').value = company.id;
                document.getElementById('cif').value = company.cif;
                document.getElementById('nombre').value = company.nombre;
                document.getElementById('domicilio').value = company.domicilio;
                document.getElementById('telefono').value = company.telefono;
                document.getElementById('email').value = company.email;
                document.getElementById('web').value = company.web;
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'No se encontraron resultados',
                });
            }
        }
    });
});