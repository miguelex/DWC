<fieldset>
    <legend>Información general</legend>
    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor" value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellidos">Apellidos: </label>
    <input type="text" id="apellidos" name="vendedor[apellidos]" placeholder="Apellidos del vendedor" value="<?php echo s($vendedor->apellidos); ?>">
</fieldset>

<fieldset>
    <legend>Información extra</legend>
    <label for="telefono">Teléfono: </label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono del vendedor" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>