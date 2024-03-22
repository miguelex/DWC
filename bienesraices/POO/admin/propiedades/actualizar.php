<?php

use App\Propiedad;

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

$errores = [];


if($_SERVER['REQUEST_METHOD']=== 'POST'){

    // Asignar los valores
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    debuguear($propiedad);

    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if(!$titulo){
        $errores[] = "Debes añadir un titulo";
    }

    if(!$precio){
        $errores[] = "Debes añadir un precio";
    }

    if(strlen($descripcion) < 50){
        $errores[] = "Debes añadir una descripción y debe tener al menos 50 caracteres";
    }

    if(!$habitaciones){
        $errores[] = "Debes añadir un número de habitaciones";
    }

    if(!$wc){
        $errores[] = "Debes añadir un número de baños";
    }

    if(!$estacionamiento){
        $errores[] = "Debes añadir un número de estacionamientos";
    }

    if(!$vendedor){
        $errores[] = "Debes añadir un vendedor";
    }

    // Validar por tamaño (1mb máximo)
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida){
        $errores[] = "La imagen es muy pesada";
    }

    if(empty($errores)){

        // Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        if($imagen['name']){
            // Eliminar la imagen previa
            unlink($carpetaImagenes . $imagenPropiedad);
        
            // Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            // subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes.$nombreImagen);
        } else {
            $nombreImagen = $imagenPropiedad;
        }

        // Insertar en BD
        $query = "UPDATE propiedades SET titulo  = '$titulo', precio  = '$precio', imagen = '$nombreImagen', descripcion  = '$descripcion', habitaciones  = $habitaciones, wc  = $wc, estacionamientos  = $estacionamiento, vendedores_id  = $vendedor WHERE id = $id";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
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