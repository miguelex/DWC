document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
  crearGaleria();
}

function crearGaleria() {
  const galeria = document.querySelector(".galeria-imagenes");

  for (let i = 1; i <= 12; i++) {
    const imagen = document.createElement("picture");
    imagen.innerHTML = ` 
      <source srcset="build/img/thumb/${i}.avif" type="image/avif" />
          <source srcset="build/img/thumb/${i}.webp" type="image/webp" />
          <img
            loading="lazy"
            width="200"
            height="300"
            src="build/img/thumb/${i}.jpg"
            alt="Imagen galeria ${i}"
          />
      `;

    imagen.onclick = function () {
      mostrarImagen(i);
    };

    galeria.appendChild(imagen);
  }
}

function mostrarImagen(id) {
  const imagen = document.createElement("picture");
  imagen.innerHTML = ` 
      <source srcset="build/img/grande/${id}.avif" type="image/avif" />
          <source srcset="build/img/grande/${id}.webp" type="image/webp" />
          <img
            loading="lazy"
            width="200"
            height="300"
            src="build/img/grande/${id}.jpg"
            alt="Imagen galeria ${id}"
          />
      `;

  const overlay = document.createElement("div");
  overlay.appendChild(imagen);
  overlay.classList.add("overlay");

  // Cuando se da click, cerrar la imagen
  overlay.onclick = function () {
    overlay.remove();
    body.classList.remove("fijar-body");
  };

  // Boton para cerrar la imagen
  const cerrarImagen = document.createElement("p");
  cerrarImagen.textContent = "X";
  cerrarImagen.classList.add("btn-cerrar");
  overlay.appendChild(cerrarImagen);

  // Cerrar imagen con el boton
  cerrarImagen.onclick = function () {
    overlay.remove();
    body.classList.remove("fijar-body");
  };

  // Mostrar en el HTML
  const body = document.querySelector("body");
  body.appendChild(overlay);
  body.classList.add("fijar-body");
}
