(function () {
    const horas = document.querySelector('#horas');

    if (horas) {
        
        const categorias = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');
        
        categorias.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
        
        let busqueda = {
            categoria_id: +categorias.value || '',
            dia: +inputHiddenDia.value || ''
        };

        if (!Object.values(busqueda).includes('')) {

            (async () => {

                await buscarEventos();
    
                // Resaltar hora actual en caso de edicion
                const horaSeleccionada = document.querySelector(`[data-hora-id="${inputHiddenHora.value}"]`);
                
                horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                horaSeleccionada.classList.add('horas__hora--seleccionada');

                horaSeleccionada.onclick = seleccionarHora;
            })();
        }
        
        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;  
            
            // Reiniciar campos ocultos y el seletor de hora
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';
            
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }


            if (Object.values(busqueda).includes('')) {
                return;
            }

            buscarEventos();
        }   

        async function buscarEventos() {
            const { dia, categoria_id } = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;
            console.log(url);

            const resultado = await fetch(url);
            const eventos = await resultado.json();
            
            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos) {

            // Reinicar las horas
            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitada'));

            // Filtrar las horas que no estan tomadas

            const horasTomadas = eventos.map(evento => evento.hora_id);
            const listadoHorasArray = Array.from(listadoHoras);
            const resultado = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId));

            resultado.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');

            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora));
        }

        function seleccionarHora(e) {
            // Deshabilitar la hora previa si hay un nuevo clic

            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }
            
            e.target.classList.add('horas__hora--seleccionada');
            inputHiddenHora.value = e.target.dataset.horaId;

            // LLenar campo oculto dia
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;

        }
    }
})(); 