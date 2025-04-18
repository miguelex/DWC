<?php 

    namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

    class LoginController {
        public static function login(Router $router){
            $alertas = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               $auth = new Usuario($_POST);
               $alertas = $auth->validarLogin();

               if (empty($alertas)) {
                   //Comprobar que existe el usuario
                   $usuario = Usuario::where('email', $auth->email);

                   if($usuario){
                        //Verificar el apssword
                        if($usuario->comprobarPasswordAndVerificado($auth->password)){
                            //autenticar al usuario
                            session_start();
                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = true;
                            // Redireccionar al usuario
                            if($usuario->admin === "1"){
                                $_SESSION['admin'] = $usuario->admin ?? null;
                                header('Location: /admin');
                            } else {
                                header('Location: /cita');
                            }
                        }
                   } else {
                        Usuario::setAlerta('error', 'El usuario no encontrado');
                   }
               }
            }
            $router->render('auth/login', [
                'alertas' => $alertas
            ]);
        }

        public static function logout(){
            echo "Desde Logout";
        }

        public static function olvide(Router $router){

            $alertas = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auth = new Usuario($_POST);
                $alertas = $auth->validarEmail();

                if (empty($alertas)) {
                    // Buscar el usuario
                    $usuario = Usuario::where('email', $auth->email);
                    if ($usuario && $usuario->confirmado === "1") {
                        // Generar un nuevo token
                        $usuario->crearToken();
                        unset($usuario->password);
                        // Actualizar el usuario
                        $usuario->guardar();
                        // Enviar el email
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarInstrucciones();
                        // Alerta de exito
                        Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                    } else {
                        Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    }
                }
            }

            // Obtener alertas
            $alertas = Usuario::getAlertas();
            $router->render('auth/olvide', [
                'alertas' => $alertas
            ]);
        }

        public static function recuperar(Router $router) {
            $alertas = [];
            $token = s($_GET['token']);
            $error = false;

            $usuario = Usuario::where('token', $token);
            if (empty($usuario)) {
                // Mostrar mensaje de error
                Usuario::setAlerta('error', 'Token No Válido');
                $error = true;
            } 
            // Mostrar el formulario para modificar el password
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               $password = new Usuario($_POST);
               $alertas = $password->validarPassword();   
               if (empty($alertas)) {
                    // Asignar el nuevo password
                    $usuario->password = $password->password;
                    // Hashear el password
                    $usuario->hashPassword();
                    // Eliminar el token
                    $usuario->token = "";
                    // Guardar el nuevo password
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /');
                    }
               }     
            }

            $router->render('auth/recuperar-password', [
                'alertas' => $alertas,
                'error' => $error,
            ]);
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

        public static function confirmar(Router $router) {
            $alertas = [];
            $token = s($_GET['token']);
            $usuario = Usuario::where('token', $token);
    
            if(empty($usuario)) {
                // Mostrar mensaje de error
                Usuario::setAlerta('error', 'Token No Válido');
            } else {
                // Modificar a usuario confirmado
                $usuario->confirmado = 1;
                $usuario->token = "";
                $usuario->guardar();
                Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
            }
           
            // Obtener alertas
            $alertas = Usuario::getAlertas();
    
            // Renderizar la vista
            $router->render('auth/confirmar-cuenta', [
                'alertas' => $alertas
            ]);
        }
    }