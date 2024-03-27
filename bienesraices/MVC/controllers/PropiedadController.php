<?php 

namespace Controllers;
use MVC\Router;

class PropiedadController {

    public static function index (Router $router)
    {
        $router->render('propiedades/admin');
    }

    public static function crear ()
    {
        echo 'Crear';
    }

    public static function actualizar ()
    {
        echo 'Actualizar';
    }
}