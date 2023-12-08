<?php


?>

<div class="contenedor-anuncios">
    <div class="anuncio">
        <picture>
            <source srcset="build/img/anuncio1.webp" type="image/webp" />
            <source srcset="build/img/anuncio1.jpg" type="image/jpeg" />
            <img loading="lazy" src="build/img/anuncio1.jpg" alt="anuncio casa en el lago" />
        </picture>
        <div class="contenido-anuncio">
            <h3>Casa de lujo en el lago</h3>
            <p>
                Casa en el lago con excelentes vistas, acabados de lujo a un
                excelente precio
            </p>
            <p class="precio">$3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy" />
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento"
                        loading="lazy" />
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones"
                        loading="lazy" />
                    <p>4</p>
                </li>
            </ul>
            <a href="anuncio.html" class="boton-amarillo-block">
                Ver propiedad</a>
        </div>
        <!-- .contenido-anuncio -->
    </div>
    <!-- .anuncio -->
</div>
<!-- .contenedor-anuncios -->

<?php
    // Cerrar la conexion
?>