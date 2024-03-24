<?php
require '../../includes/app.php';

use App\Propiedad; 
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

//Base de datos

$db = conectarDB();

$propiedad = new Propiedad();

// Consulta para obtener vendedores

$query = "SELECT * FROM vendedores";
$result = mysqli_query($db, $query);

// Arreglo con mensajes de errores

$errores = Propiedad::getErrores();

if($_SERVER['REQUEST_METHOD']=== 'POST'){

    $propiedad = new Propiedad($_POST['propiedad']);

    // Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Realiza el resize a la imagen
    
    if($_FILES['propiedad']['tmp_name']['imagen']){
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();    

    if(empty($errores)){         

        // Crear la carpeta para subir imagenes

        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        // Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guardar en BD

        $propiedad->guardar();   
    }    

}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
    incluirTemplate('footer');
?>