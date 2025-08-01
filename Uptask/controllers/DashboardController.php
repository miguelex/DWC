<?php 

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        session_start();

        isAuth();

        $proyectos = Proyecto::belongsTo('propietarioId', $_SESSION['id']);

        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos'=> $proyectos
        ]);
    }

    public static function crear(Router $router) {
        session_start();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                // Generar URL unica
                $proyecto->url = md5(uniqid(rand(), true));
                // Asignar el propietario del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                // Guardar el proyecto en la base de datos
                $proyecto->guardar();
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router) {
        session_start();

        isAuth();

        // Revisar que la persona que visita el proyecto es quien lo creo

        $token = $_GET['id'];

        if(!$token) {
            header('Location: /dashboard');
        }

        $proyecto = Proyecto::where('url', $token);

        if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }


        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router) {
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);
                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    Usuario::setAlerta('error', 'El Email ya está en uso');
                    $alertas = $usuario->getAlertas();
                } else {
                    $usuario->guardar();
                    Usuario::setAlerta('exito', 'Perfil actualizado correctamente');
                    $alertas = $usuario->getAlertas();
                    $_SESSION['nombre'] = $usuario->nombre;
                }
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiarPassword(Router $router) {
        session_start();
        $alertas = [];
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevoPassword();

            if (empty($alertas)) {
                $resultado = $usuario->comprobarPassword();
                if ($resultado) {
                    unset ($usuario->password_actual);
                    $usuario->password = $usuario->password_nuevo;
                    unset ($usuario->password_nuevo);
                    $usuario->hashPassword();
                    $resultado =$usuario->guardar();
                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Password actualizado correctamente');
                        $alertas = $usuario->getAlertas();
                    }
                } else {
                    Usuario::setAlerta('error', 'El Password Actual es incorrecto');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas
        ]);
    }

}