document.getElementById('form').addEventListener('submit', function(event) {
    event.preventDefault();

    var Contraseña = document.getElementById('Contraseña').value;
    var Correo = document.getElementById('Correo').value;
    var errorMessage = document.getElementById('error-message');
    const regexEmail = /^.+@.+\..+$/;
    

        
    if (regexEmail.test(Correo.value)) {
        errorMessage.textContent = 'El email no es válido';
        return;
    }
    if (Contraseña.length <= 8) {
        errorMessage.textContent = 'La contraseña debe tener más de 8 caracteres.';
        return;
    } 
        
    form.submit();
    window.location.href = "/html/interfaz-cliente.html";
});