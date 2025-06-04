document.addEventListener('DOMContentLoaded', function() {
    inicarApp();
});

function inicarApp() {
    buscarPorFecha();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', function(e) {
        const fechaSeleccionada = e.target.value;
        window.location.href = `?fecha=${fechaSeleccionada}`;
    });
}