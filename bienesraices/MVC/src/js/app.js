document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});

function darkMode() {
  const themeColor = window.matchMedia("(prefers-color-scheme: dark)");
  if (themeColor.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  themeColor.addEventListener("change", function () {
    if (themeColor.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const botonDarkMode = document.querySelector(".dark-mode-boton");
  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");

    //Para que el modo elegido se quede guardado en local-storage
    if (document.body.classList.contains("dark-mode")) {
      localStorage.setItem("modo-oscuro", "true");
    } else {
      localStorage.setItem("modo-oscuro", "false");
    }
  });

  //Obtenemos el modo del color actual
  if (localStorage.getItem("modo-oscuro") === "true") {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }
}
function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navegacionResponsive);

  // Muestas campos condicionales

  const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
  metodoContacto.forEach((input) => {
    input.addEventListener("click", mostrarMetodoContacto);
  });
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");
  navegacion.classList.toggle("mostrar");
}

function mostrarMetodoContacto(e) {
  const contactoDiv = document.querySelector("#contacto");
  if (e.target.value === "telefono") {
    contactoDiv.innerHTML = `
    <label for="telefono">Número Teléfono</label>
    <input type="tel" id="telefono" name="contacto[telefono]" placeholder="Tu Teléfono">

    <p>Elija la fecha y hora para la llamada</p>
    
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha"  name ="contacto[fecha]"/>
    
    <label for="hora">Hora:</label>
    <input type="time" id="hora" min="09:00" max="18:00"  name ="contacto[hora]"/>
    `;
  } else {
    contactoDiv.innerHTML = `
    <label for="email">Email</label>
    <input type="email" id="email" name="contacto[email]" placeholder="Tu Email">
    `;
  }
}


