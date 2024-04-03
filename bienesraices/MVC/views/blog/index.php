<main class="contenedor seccion">
    <h1>Gestión del Blog</h1>
    
    <?php 
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class = "alerta exito"><?php echo s($mensaje) ?></p>
            <?php }
        }
    ?>
        

    <a href="/admin" class="boton boton-verde">Volver</a>
    <a href="/blog/crear" class="boton boton-amarillo">Añadir entrada</a>

    <h2>Listado de Entradas</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Resumen</th>
                <th>Escrito</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($entradas as $entrada): ?>
            <tr>
                <td><?php echo $entrada->id; ?></td>
                <td><?php echo $entrada->titulo; ?></td>
                <td><img src="/imagenes/blog/<?php echo $entrada->imagen; ?>" class="imagen-tabla"></td>
                <td><?php echo substr($entrada->texto,0, 50) . '...'; ?></td>
                <td><?php echo $entrada->escrito; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/blog/eliminar">
                        <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                        <input type="hidden" name="tipo" value="blog">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href=" /blog/actualizar?id=<?php echo $entrada->id; ?>"
                        class="boton-edit-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>