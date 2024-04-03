<?php foreach($blog as $entrada) {
    $fecha = $entrada->escrito;
    $fecha = date("d/m/Y", strtotime($fecha));
    $autor = '';

    foreach ($vendedores as $vendedor) {
        if ($vendedor->id === $entrada->vendedorId) {
            $autor = $vendedor->nombre. ' ' . $vendedor->apellidos;
            break;
        }
    }
?>
<article class="entrada-blog">
    <div class="imagen">
        <picture>
            <source srcset="/imagenes/blog/<?php echo $entrada->imagen; ?>" type="image/webp" />
            <source srcset="/imagenes/blog/<?php echo $entrada->imagen; ?>" type="image/jpeg" />
            <img loading="lazy" src="/imagenes/blog/<?php echo $entrada->imagen; ?>" alt="Texto entrada blog" />
        </picture>
    </div>
    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $entrada->id; ?>">
            <h4><?php echo $entrada->titulo; ?></h4>
            <p class="informacion-meta">
                Escrito el: <span><?php echo $fecha; ?></span> por: <span><?php echo $autor ?></span>
            </p>
            <p>
                <?php echo substr($entrada->texto, 0, 100) . '...'; ?>
            </p>
        </a>
    </div>
</article>
<?php } ?>