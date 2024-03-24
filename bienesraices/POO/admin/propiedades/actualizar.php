<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

estaAutenticado();


//Validar id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}


$propiedad = Propiedad::find($id);

// Consulta para obtener vendedores

$query = "SELECT * FROM vendedores";
$result = mysqli_query($db, $query);

// Arreglo con mensajes de errores

$errores = Propiedad::getErrores();


if($_SERVER['REQUEST_METHOD']=== 'POST'){

    // Asignar los valores
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    // Validacion
    $errores = $propiedad->validar();    

    //Subida de imagenes

    // Generar nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Realiza el resize a la imagen
    
    if($_FILES['propiedad']['tmp_name']['imagen']){
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    if(empty($errores)){
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        $resultado = $propiedad->guardar();
    }    

}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>

    <a href="/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
    incluirTemplate('footer');
?>