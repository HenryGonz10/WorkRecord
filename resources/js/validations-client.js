function validateClientForm(event) {
    var isValid = true;

    // Validar CIF
    var cif = document.getElementById("cif");
    var cifError = document.getElementById("cifError");
    if (cif.value.trim() === "") {
        cifError.classList.remove("hidden");
        isValid = false;
    } else {
        cifError.classList.add("hidden");
    }

    // Validar Nombre
    var nombre = document.getElementById("nombre");
    var nombreError = document.getElementById("nombreError");
    if (nombre.value.trim() === "") {
        nombreError.classList.remove("hidden");
        isValid = false;
    } else {
        nombreError.classList.add("hidden");
    }

    // Validar Email
    var email = document.getElementById("email");
    var emailError = document.getElementById("emailError");
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value.trim())) {
        emailError.classList.remove("hidden");
        isValid = false;
    } else {
        emailError.classList.add("hidden");
    }

    if (!isValid) {
        // Prevenir que el formulario se envíe si no es válido
        event.preventDefault();
    }
}

// Agregar event listener al formulario con id 'frmClient'
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("frmClient");
    form.addEventListener("submit", validateClientForm);
});