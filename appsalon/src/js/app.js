let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: "",
    fecha: "",
    hora: "",
    servicios: [],
}

document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
    mostrarSeccion();
    tabs();
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();
    consultarAPI();
    // formularioContacto();
    // iniciarMapas();
}

function mostrarSeccion() {

    //Ocultar todas las secciones
    const seccionAnterior = document.querySelector(".mostrar");
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    //Seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase actual al anterior
    const tabAnterior = document.querySelector(".actual");
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs () {
    const botones = document.querySelectorAll(".tabs button");

    botones.forEach((boton) => {
        boton.addEventListener("click", function (e) {
            paso = parseInt(e.target.dataset.paso); 
            mostrarSeccion();
            botonesPaginador();
        });

    });
}

function botonesPaginador() {
    const paginaSiguiente = document.querySelector("#siguiente");
    const paginaAnterior = document.querySelector("#anterior");

    if (paso === 1) {
        paginaAnterior.classList.add("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    } else if (paso === 3) {
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.add("ocultar");
    } else {
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    }

    mostrarSeccion();
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector("#siguiente");
    paginaSiguiente.addEventListener("click", function () {
        if (paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector("#anterior");
    paginaAnterior.addEventListener("click", function () {
        if (paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

async function consultarAPI() {
    try {
        const url = 'http://localhost:8000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;
        const nombreServicio = document.createElement("P");
        nombreServicio.textContent = nombre;
        nombreServicio.classList.add("nombre-servicio");

        const precioServicio = document.createElement("P");
        precioServicio.textContent = `${precio}€`;
        precioServicio.classList.add("precio-servicio");

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        servicioDiv.dataset.idServicio = id;

        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        };
        
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDiv);
    });

}

function seleccionarServicio(servicio) {
    const { servicios } = cita;
    const { id } = servicio;
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si el servicio ya fue agregado
    if ( servicios.some(agregado => agregado.id === id)) {
        // Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove("seleccionado");
    } else {
        // Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add("seleccionado");
    }
}