
var botonBorrar = document.getElementById('borrador');
var campoClave = document.getElementById('claveFinal');

botonBorrar.addEventListener('click', function() {
    // Borra el contenido del campo de entrada
    campoClave.value = '';
  });
