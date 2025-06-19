<?php 

namespace Controllers;

use MVC\Router;

class LoginController {

    public static function login(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
        ]);
    }

    public static function logout() {
        echo "Desde Logout";
    }

    public static function crear(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('auth/crear', [
            'titulo' => 'Crear tu cuenta',
        ]);
    }

    public static function olvide() {
        echo "Desde Olvide";

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
    }

    public static function reestablecer() {
        echo "Desde Reestablecer";

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
    }

    public static function confirmar() {
        echo "Desde Confirmar";
    }

    public static function mensaje() {
        echo "Desde Mensaje";
    }
}