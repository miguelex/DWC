<main class="contenedor seccion contenido-centrado">
    <h1>Contacto</h1>

    <?php if ($mensaje) : ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp" />
        <source srcset="build/img/destacada3.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de Contacto" />
    </picture>
    <h2>Llene el formulario de contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name ="contacto[nombre]" required/>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje"  name ="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select id="opciones"  name ="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto:</label>
            <input type="number" id="presupuesto" placeholder="Tu Precio"  name ="contacto[precio]" required/>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono"  name ="contacto[contacto]" required/>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email"  name ="contacto[contacto]" required/>
            </div>

            <div id="contacto"></div>

        </fieldset>
        <!-- Boton submit -->
        <input type="submit" value="Enviar" class="boton-verde" />
    </form>
</main>