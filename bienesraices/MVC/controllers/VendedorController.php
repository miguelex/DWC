<?php 

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear (Router $router)
    {
        $vendedor = new Vendedor;
        // Arreglo con mensajes de errores

        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $vendedor = new Vendedor($_POST['vendedor']);
        
            $errores = $vendedor->validar();
        
            if(empty($errores)){
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

            if(empty($errores)){
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
                    $vendedor->eliminar();
                }
            }
        }
    }
}