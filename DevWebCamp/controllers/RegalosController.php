<?php

namespace Controllers;

use MVC\Router;

class RegalosController {
    public static function index(Router $router) {

        // Render a la vista 
        $router->render('admin/regalos/index', [
            'titulo' => 'Regalos'
        ]);
    }
}