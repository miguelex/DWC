<?php
    include 'includes/app.php';

    use App\Propiedad;
    
    // Importar la conexión
    $db = conectarDB();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    $propiedad = Propiedad::find($id);

    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio" />

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy" />
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento"
                    loading="lazy" />
                <p><?php echo $propiedad->estacionamientos; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy" />
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p>
        <?php echo $propiedad->descripcion; ?>
        </p>
    </div>
</main>

