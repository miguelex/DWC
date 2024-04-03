<fieldset>
    <legend>Entrada</legend>
    <label for="titulo">Titulo: </label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo de la entrada" value="<?php echo s($blog->titulo); ?>">

    <label for="imagen">Imagen: </label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">

    <?php if($blog->imagen) { ?>
    <img src="/imagenes/blog/<?php echo $blog->imagen; ?>" class="imagen-small">
    <?php } ?>

    <label for="texto">Entrada: </label>
    <textarea id="texto" name="blog[texto]"><?php echo s($blog->texto); ?></textarea>
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="blog[vendedorId]" id="vendedor">
        <option value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor) { ?>
            <option <?php echo $blog->vendedorId === $vendedor->id ? 'selected' : '' ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellidos); ?>
        <?php  } ?>
    </select>
</fieldset>