<?php 

    namespace Controllers;

use Model\Usuario;
use MVC\Router;

    class LoginController {
        public static function login(Router $router){
            $router->render('auth/login');
        }

        public static function logout(){
            echo "Desde Logout";
        }

        public static function olvide(Router $router){
            $router->render('auth/olvide', [

            ]);
        }

        public static function recuperar(){
            echo "Desde Recuperar";
        }

        public static function crear(Router $router){

            $usuario = new Usuario;

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $usuario->sincronizar($_POST);
            }
            
            $router->render('auth/crear', ['usuario' => $usuario]);
            
        }
    }