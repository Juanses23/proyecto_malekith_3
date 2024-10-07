document.getElementById('form').addEventListener('submit', function(event) {
    event.preventDefault();

    const contra1 = document.getElementById("contra1").value;
    const contra2 = document.getElementById("contra2").value;
    var errorMessage = document.getElementById('error-message');
 
    if (contra1 !== contra2) {
        errorMessage.textContent = 'Las contraseñas no son iguales';
        return;
    }else{
        errorMessage.textContent = '';
    }
        
    form.submit();
    window.location.href = "/index.html";
});