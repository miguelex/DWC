import Swal from "sweetalert2";

(function () {
    let eventos = [];

    const resumen = document.querySelector('#registro-resumen');
    const eventosBoton = document.querySelectorAll('.evento__agregar');
    eventosBoton.forEach(boton => boton.addEventListener('click', seleccionarEvento));


    function seleccionarEvento({target}) {
        
        if(eventos.length < 5) {
            // Deshabilitar el evento
            
            target.disabled = true;
            
            eventos = [...eventos, {
                id: target.dataset.id,
                titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
            }];

            mostrarEventos();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Límite de eventos alcanzado',
                text: 'Solo puedes registrar hasta 5 eventos',
                confirmButtonText: 'OK'
            });
        }
    }

    function mostrarEventos() {
        // Limpiar el HTML previo
        limpiarEventos();

        if(eventos.length > 0) {
            eventos.forEach(evento => {
                const eventoDOM = document.createElement('DIV');
                eventoDOM.classList.add('registro__evento');

                const titulo = document.createElement('H3');
                titulo.classList.add('registro__nombre');
                titulo.textContent = evento.titulo;

                const botonEliminar = document.createElement('BUTTON');
                botonEliminar.classList.add('registro__eliminar');
                botonEliminar.innerHTML = '<i class="fa-solid fa-trash"></i>';
                botonEliminar.onclick = function() {
                    // Eliminar evento del arreglo
                    eliminarEvento(evento.id);
                }

                // renderizar
                eventoDOM.appendChild(titulo);
                eventoDOM.appendChild(botonEliminar);
                resumen.appendChild(eventoDOM);
            })
        }
    }

    function limpiarEventos() {
        while(resumen.firstChild) {
            resumen.removeChild(resumen.firstChild);
        }
    }

    function eliminarEvento(id) {
        eventos = eventos.filter(evento => evento.id !== id);
        const botonAgregar = document.querySelector(`[data-id="${id}"]`);
        botonAgregar.disabled = false;
        mostrarEventos();
    }

})();