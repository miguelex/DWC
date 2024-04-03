<?php 

namespace Controllers;
use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController {
    public static function crear (Router $router)
    {
        $vendedor = new Vendedor;
        // Arreglo con mensajes de errores

        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $vendedor = new Vendedor($_POST['vendedor']);

            // Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Realiza el resize a la imagen

            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImagen($nombreImagen, CARPETA_VENDEDORES);
            }

        
            $errores = $vendedor->validar();
        
            if (empty($errores)) {

                // Crear la carpeta para subir imagenes

                if (!is_dir(CARPETA_VENDEDORES)) {
                    mkdir(CARPETA_VENDEDORES);
                }

                // Guardar la imagen en el servidor
                $image->save(CARPETA_VENDEDORES . $nombreImagen);

                // Guardar en BD

                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar (Router $router)
    {
        $id = validarORedireccionar('/admin');

        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Asignar los atributos
            $args = $_POST['vendedor'];
            
            $vendedor->sincronizar($args);

            $errores = $vendedor->validar();

            // Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            // Realiza el resize a la imagen
            
            if($_FILES['vendedor']['tmp_name']['imagen']){
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                $vendedor->setImagen($nombreImagen, CARPETA_VENDEDORES);
            }
        
            if(empty($errores)){
                if($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image->save(CARPETA_VENDEDORES . $nombreImagen);
                }
                
                $vendedor->guardar();
            }    
        
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar ()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            if($id){
        
                $tipo = $_POST['tipo'];
        
                if (validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar(CARPETA_VENDEDORES);
                }
            }
        }
    }
}