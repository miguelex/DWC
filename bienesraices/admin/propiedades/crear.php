<?php

//Base de datos
require '../../includes/config/database.php';
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
$creado = date('Y-m-d');
    
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedor = $_POST['vendedor'];

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

    if(empty($errores)){
        // Insertar en BD
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamientos, creado, vendedores_id) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedor')";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: /admin');
        }
    }
    

}


require '../../includes/funciones.php';

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

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend>Información general</legend>
            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad"
                value="<?php echo $precio; ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

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

            <select name="vendedor">
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