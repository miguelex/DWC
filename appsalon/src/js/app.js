let paso = 1;

document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
    // mostrarSeccion();
    tabs();
    // botonesPaginador();
    // paginaSiguiente();
    // paginaAnterior();
    // consultarAPI();
    // formularioContacto();
    // iniciarMapas();
}

function mostrarSeccion() {
    
}

function tabs () {
    const botones = document.querySelectorAll(".tabs button");

    botones.forEach((boton) => {
        boton.addEventListener("click", function (e) {
            paso = parseInt(e.target.dataset.paso); 
            mostrarSeccion();
        });

    });
}