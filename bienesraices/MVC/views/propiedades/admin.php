<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>
    
    <?php 
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class = "alerta exito"><?php echo s($mensaje) ?></p>
            <?php }
        }
    ?>
        

    <a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo vendedor</a>
    <a href="/blog/index" class="boton boton-amarillo">Gestionar Blog</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img src="/imagenes/propiedades/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                <td>$ <?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href=" /propiedades/actualizar?id=<?php echo $propiedad->id; ?>"
                        class="boton-edit-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Foto</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre. " ".$vendedor->apellidos; ?></td>
                <td><img src="/imagenes/vendedores/<?php echo $vendedor->imagen; ?>" class="imagen-tabla"></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td><?php echo $vendedor->email; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>"
                        class="boton-edit-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>