
document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencia a los radio buttons y a los div del formulario
    var radioVisa = document.getElementById('visa');
    var radioMastercard = document.getElementById('mastercard');
    var radioOxxo = document.getElementById('oxxo');
    
    var formularioVisa = document.getElementById('show-visa');
    var formularioOxxo = document.getElementById('show-oxxo');

    // Añadir event listeners para los radio buttons
    radioVisa.addEventListener('change', function () {
        if (radioVisa.checked) {
            formularioVisa.style.display = 'block';
            formularioOxxo.style.display = 'none';
        }
    });

    radioMastercard.addEventListener('change', function () {
        if (radioMastercard.checked) {
            formularioVisa.style.display = 'block';
            formularioOxxo.style.display = 'none';
        }
    });

    radioOxxo.addEventListener('change', function () {
        if (radioOxxo.checked) {
            formularioVisa.style.display = 'none';
            formularioOxxo.style.display = 'block';
        }
    });
});