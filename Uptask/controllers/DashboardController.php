<?php 

namespace Controllers;

use Model\Proyecto;
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

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil'
        ]);
    }
}