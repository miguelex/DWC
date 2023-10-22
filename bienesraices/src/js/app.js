document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});

function darkMode() {
  const botonDarkMode = document.querySelector(".dark-mode-boton");
  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
    botonDarkMode.classList.toggle("active");
    /*if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'true');
        } else {
            localStorage.setItem('dark-mode', 'false');
        }*/
  });
}
function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");
  navegacion.classList.toggle("mostrar");
}
