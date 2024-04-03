<fieldset>
    <legend>Información general</legend>
    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor" value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellidos">Apellidos: </label>
    <input type="text" id="apellidos" name="vendedor[apellidos]" placeholder="Apellidos del vendedor" value="<?php echo s($vendedor->apellidos); ?>">

    <label for="imagen">Imagen: </label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]">

    <?php if($vendedor->imagen) { ?>
    <img src="/imagenes/vendedores/<?php echo $vendedor->imagen; ?>" class="imagen-small">
    <?php } ?>
</fieldset>

<fieldset>
    <legend>Información extra</legend>
    <label for="telefono">Teléfono: </label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono del vendedor" value="<?php echo s($vendedor->telefono); ?>">

    <label for="email">Correo Electrónico: </label>
    <input type="email" id="email" name="vendedor[email]" placeholder="Email del vendedor" value="<?php echo s($vendedor->email); ?>">
</fieldset>