<?php 

namespace Controllers;

use Model\Tarea;
use Model\Proyecto;

class TareaController {
    public static function index() {
        session_start();
        $proyectoId = $_GET['id'];

        if(!$proyectoId) 
            header('Location: /dashboard');
        $proyecto = Proyecto::where('url', $proyectoId);

        if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) 
            header('Location: /404');

        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);
        
        echo json_encode([
            'tareas' => $tareas,
        ]);
    }

    public static function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $proyectoId = $_POST['proyectoId'];

            $proyecto = Proyecto::where('url', $proyectoId);

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al intentar crear la tarea',
                ];
                echo json_encode($respuesta);
                return;
            } 
            
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea creada correctamente',
                'proyectoId' => $proyecto->id,
            ];
            
            echo json_encode($respuesta);              
        }
    }

    public static function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al intentar actualizar la tarea',
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;

            $resultado = $tarea->guardar();

            if($resultado){
                 $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea,
                    'proyectoId' => $proyecto->id,
                    'mensaje' => 'Tarea actualizada correctamente',
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }

        }
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al intentar eliminar la tarea',
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Tarea eliminada correctamente',
                'tipo' => 'exito'
            ];

            echo json_encode($resultado);

        }
    }
}