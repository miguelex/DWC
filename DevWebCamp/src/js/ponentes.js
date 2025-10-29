(function () {
    const ponentesInput = document.querySelector('#ponentes');

    if (ponentesInput) {
        let ponentes = [];
        let ponentesFiltrados = [];
        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('input[name="ponente_id"]');

        obtenerPonentes();

        ponentesInput.addEventListener('input', buscarPonentes);

        if(ponenteHidden.value) {
            (async() => {
                const ponente = await obtenerPonente(ponenteHidden.value);
                const ponenteHTML = document.createElement('LI');
                ponenteHTML.classList.add('listado-ponentes__ponente', 'listado-ponentes__ponente--seleccionado');
                ponenteHTML.textContent = `${ponente.nombre.trim()} ${ponente.apellido.trim()}`;
                listadoPonentes.appendChild(ponenteHTML);
            })();  
        }

        async function obtenerPonentes() {
            const url = '/api/ponentes';
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            formatearPonentes(resultado);
        }

        async function obtenerPonente(id) {
            const url = `/api/ponente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            return resultado;
        }

        function formatearPonentes(arrayPonentes = []) {
            ponentes = arrayPonentes.map(ponente => {
                return {
                    id: ponente.id,
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`
                }
            });
        }

        function buscarPonentes(e) {
            const busqueda = e.target.value.toLowerCase();
            
            if (busqueda.length > 3) {
                const expresion = new RegExp(busqueda, 'i');
                ponentesFiltrados = ponentes.filter(ponente => {
                    if (ponente.nombre.toLowerCase().search(expresion) !== -1) {
                        return ponente;
                    }
                });
            } else {
                ponentesFiltrados = [];
            }

            mostrarPonentes();
        }

        function mostrarPonentes() {

            while (listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;
                    
                    listadoPonentes.appendChild(ponenteHTML);
                });
            } else {
                const noResultado = document.createElement('P');
                noResultado.classList.add('listado-ponentes__no-resultado');
                noResultado.textContent = 'No hay resultados';
                listadoPonentes.appendChild(noResultado);
            }
        }

        function seleccionarPonente(e) {
            const ponente = e.target;

            const ponentePrevio = listadoPonentes.querySelector('.listado-ponentes__ponente--seleccionado');
            
            if (ponentePrevio) {
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
            }

            ponente.classList.add('listado-ponentes__ponente--seleccionado');
            ponenteHidden.value = ponente.dataset.ponenteId;   
        }
    }
})();