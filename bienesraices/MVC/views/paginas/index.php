<main class="contenedor seccion">
    <h1>Más sobre nosotros</h1>
    <?php 
        include 'iconos.php';
    ?>
</main>

<section class="seccion contenedor">
    <h2>Casas y Departamentos en venta</h2>

    <?php
        include 'listado.php';
    ?>
    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuenta la casa de tus sueños</h2>
    <p>Rellena el formulario y un asesor se pondrá en contacto contigo</p>
    <a href="contacto.php" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        <?php
            include 'listadoB.php';
        ?>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención
                y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Migue Delgado</p>
        </div>
</div>
