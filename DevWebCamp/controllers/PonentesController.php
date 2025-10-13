<?php

namespace Controllers;

use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Ponente;
use MVC\Router;

class PonentesController {
    public static function index(Router $router) {

        $pagina_actual = $_GET["page"];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if(!$pagina_actual || $pagina_actual < 1) {
            header("Location: /admin/ponentes?page=1");
        }

        $registros_por_pagina = 10;
        $total = Ponente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header("Location: /admin/ponentes?page=1");
        }

        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

        if(!is_admin()){
            header("Location: /login");
        }
        // Render a la vista 
        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()){
            header("Location: /login");
        }
        $alertas = [];

        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Leer imagen

            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagen = '../public/img/speakers/';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagen)){
                    mkdir($carpeta_imagen, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true ) );

                $_POST['imagen'] = $nombre_imagen;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();

            // Guardar el registro

            if (empty($alertas)) {
                // Guardar las imagenes
                $imagen_png->save($carpeta_imagen . '/'. $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagen . '/'. $nombre_imagen . ".webp");

                // Guardar en BD

                $resultado = $ponente->guardar();
                if (!empty($resultado)) {
                    header('Location: /admin/ponentes');
                }

            }
        }

        // Render a la vista 
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Crear Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()){
            header("Location: /login");
        }
        $alertas = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/ponentes');
        }

        $ponente = Ponente::find($id);

        if (!$ponente) {
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        $redes = json_decode($ponente->redes);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Leer imagen

            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagen = '../public/img/speakers/';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagen)){
                    mkdir($carpeta_imagen, 0755, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5( uniqid( rand(), true ) );

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();

            // Guardar el registro

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    // Guardar las imagenes
                    $imagen_png->save($carpeta_imagen . '/'. $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagen . '/'. $nombre_imagen . ".webp");
                }

                // Guardar en BD

                $resultado = $ponente->guardar();
                if (!empty($resultado)) {
                    header('Location: /admin/ponentes');
                }

            }
        }

        // Render a la vista 
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes
        ]);
    }

    public static function eliminar() {
        if(!is_admin()){
            header("Location: /login");
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $ponente = Ponente::find($id);
                if(!empty($ponente)) {
                    $resultado = $ponente->eliminar();
                    if($resultado) {
                        header('Location: /admin/ponentes');
                    }
                }
            } else {
                header('Location: /admin/ponentes');
            }
        }
    }
}