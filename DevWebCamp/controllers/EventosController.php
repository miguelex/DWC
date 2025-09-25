<?php

namespace Controllers;

use MVC\Router;

class EventosController {
    public static function index(Router $router) {

        // Render a la vista 
        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias/Workshops'
        ]);
    }
}