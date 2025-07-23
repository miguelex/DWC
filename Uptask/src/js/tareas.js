(function(){
    obtenerTareas();
    // botonn para mostrar modal de agregar tarea
    const agregarTareaBtn = document.querySelector('#agregar-tarea');
    agregarTareaBtn.addEventListener('click', mostrarFormulario);

    async function obtenerTareas() {
        try {
            const id = obtenerProyecto();
            const url = `api/tareas?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            const { tareas } = resultado;
            mostrarTareas(tareas);
        } catch (error) {
            console.log(error);
        }
    }

    function mostrarTareas(tareas) {
        if( tareas.length === 0 ) {
            const contenedorTareas = document.querySelector('#listado-tareas');
            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = 'No hay tareas en este proyecto';
            textoNoTareas.classList.add('no-tareas');

            contenedorTareas.appendChild(textoNoTareas);
            return;
        }

        const estados = {
            0: 'Pendiente',
            1: 'Completo'
        };

        tareas.forEach(tarea => {
            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add('tarea');

            const nombreTarea = document.createElement('P');
            nombreTarea.textContent = tarea.nombre;

            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');
            
            const btnEstadoTarea = document.createElement('BUTTON');
            btnEstadoTarea.classList.add('estado-tarea');
            btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
            btnEstadoTarea.textContent = estados[tarea.estado];
            btnEstadoTarea.dataset.estadoTarea = tarea.estado;

            const btnEliminarTarea = document.createElement('BUTTON');
            btnEliminarTarea.classList.add('eliminar-tarea');
            btnEliminarTarea.dataset.tareaId = tarea.id;
            btnEliminarTarea.textContent = 'Eliminar';

            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);

            const listadoTareas = document.querySelector('#listado-tareas');
            listadoTareas.appendChild(contenedorTarea);
        });
    }

    function mostrarFormulario() {
        const modal = document.createElement('DIV');
        modal.classList.add('modal', 'modal-formulario');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Añadir una nueva Tarea</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input type="text" name="tarea" id="tarea" placeholder="Nombre de la tarea">
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea">
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 0);

        modal.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 500);
            }

            if( e.target.classList.contains('submit-nueva-tarea')) {
                submitFormularioNuevaTarea();
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        const tarea = document.querySelector('#tarea').value.trim();
        if (tarea === '') {
            mostrarAlerta('El nombre de la tarea es obligatorio', 'error', document.querySelector('.formulario legend'));
            return;
        }
        agregarTarea(tarea);
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
        const alertaExistente = document.querySelector('.alerta');
        if (alertaExistente) {
            alertaExistente.remove();
        }
        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    async function agregarTarea(tarea) {
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());
        
        try {
            const url='http://localhost:8000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            
            const resultado = await respuesta.json();
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));

            if( resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 3000);
                
            }

        } catch (error){
            console.log(error);
        }
    }

    function obtenerProyecto(){
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }

})();

