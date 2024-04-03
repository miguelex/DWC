<?php 
    $fecha = $blog->escrito;
    $fecha = date("d/m/Y", strtotime($fecha));
    $autor = $vendedor->nombre. ' ' . $vendedor->apellidos;
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo ?></h1>
    <picture>
        <source srcset="imagenes/blog/<?php echo $blog->imagen; ?>" type="image/webp" />
        <source srcset="imagenes/blog/<?php echo $blog->imagen; ?>" type="image/jpeg" />
        <img loading="lazy" src="imagenes/blog/<?php echo $blog->imagen; ?>" alt="anuncio" />
    </picture>

    <p class="informacion-meta">
        Escrito el: <span><?php echo $fecha; ?></span> por: <span><?php echo $autor; ?></span><img loading="lazy" class = "avatar" src="imagenes/vendedores/<?php echo $vendedor->imagen; ?>" alt="avatar" />
    </p>

    <div class="resumen-propiedad">
        <p>
        <?php echo $blog->texto; ?>
        </p>
    </div>
</main>