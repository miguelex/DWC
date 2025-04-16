<?php 

    namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

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

            //Alertas vacias
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();

                // Revisar que alerta esta vacio 

                if (empty($alertas)){
                    // Verificar que el usuario no exista
                    $resultado = $usuario->existeUsuario();
                    if ($resultado->num_rows) {
                        $alertas = Usuario::getAlertas();
                    } else {
                        // hashear password
                        $usuario->hashPassword();
                        // Generar token
                        $usuario->crearToken();
                        // Enviar email
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        // Crear el usuario
                        $resultado = $usuario->guardar();
                        if ($resultado) {
                            header('Location: /mensaje');
                        } else {
                            $alertas = Usuario::getAlertas();
                        } 
                    }
                }
            }
            
            $router->render('auth/crear', ['usuario' => $usuario, 'alertas' => $alertas]);
            
        }

        public static function mensaje(Router $router){
            $router->render('auth/mensaje');
        }
    }