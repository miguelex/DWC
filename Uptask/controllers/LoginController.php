<?php 

namespace Controllers;

use Classes\Email;
use Model\Usuario;
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

        $usuario = new Usuario();
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            $existeUsuario = Usuario::where('email', $usuario->email);   
            
            if (empty($alertas)) {
                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {

                    // Crear el usuario
                    $usuario->hashPassword();
                    unset($usuario->password2); // Eliminar el campo password2
                    $usuario->crearToken();
                    $resultado = $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    
                    if ($resultado) {   
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear', [
            'titulo' => 'Crear tu cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('auth/olvide', [
            'titulo' => 'Olvidé mi contraseña',
        ]);
    }

    public static function reestablecer(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer contraseña',
        ]);
    }

    public static function confirmar(Router $router) {
        $token = s($_GET['token']);
        
        if(!$token) {
            header('Location: /');
        }
        
        $usuario = Usuario::where('token', $token);

        if(empty($usuario) || !$usuario->confirmado) {
            Usuario::setAlerta('error', 'Token no válido');
            $alertas = Usuario::getAlertas();
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            unset($usuario->password2); // Eliminar el campo password2
            $usuario->token = null; // Limpiar el token
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'titulo' => 'Confirmar cuenta',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta creada exitósamente',
        ]);
    }
}