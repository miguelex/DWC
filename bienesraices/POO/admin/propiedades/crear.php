<?php
require '../../includes/app.php';

use App\Propiedad; 

estaAutenticado();

//Base de datos

$db = conectarDB();

// Consulta para obtener vendedores

$query = "SELECT * FROM vendedores";
$result = mysqli_query($db, $query);

// Arreglo con mensajes de errores

$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedor = '';

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    
    $propiedad = new Propiedad($_POST);

    $propiedad->guardar();    

    $titulo = mysqli_real_escape_string($db,$_POST['titulo']);
    $precio = mysqli_real_escape_string($db,$_POST['precio']);
    $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db,$_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db,$_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db,$_POST['estacionamiento']);
    $vendedor = mysqli_real_escape_string($db,$_POST['vendedor']);
    $creado = date('Y-m-d');

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

    if(!$imagen['name'] || $imagen['error']){
        $errores[] = "La imagen es obligatoria";
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

        // Generar nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes.$nombreImagen);

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
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
        <fieldset>
            <legend>Información general</legend>
            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad"
                value="<?php echo $precio; ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción: </label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9"
                value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento: </label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9"
                value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">-- Seleccione un vendedor --</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option <?php echo $vendedor === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>">
                    <?php echo $row['nombre'] . " " . $row['apellidos']; ?>
                </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
    incluirTemplate('footer');
?>