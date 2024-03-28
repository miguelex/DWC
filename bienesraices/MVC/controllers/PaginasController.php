<?php 

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;

    class PaginasController {

        public static function index(Router $router) {

            $propiedades = Propiedad::get(3);
            $inicio = true;
            $router->render('paginas/index', [
                'propiedades' => $propiedades,
                'inicio' => $inicio
            ]);
        }

        public static function nosotros() {
            echo "Desde el controlador de páginas";
        }

        public static function propiedades() {
            echo "Desde el controlador de páginas";
        }

        public static function propiedad() {
            echo "Desde el controlador de páginas";
        }

        public static function blog() {
            echo "Desde el controlador de páginas";
        }

        public static function entrada() {
            echo "Desde el controlador de páginas";
        }

        public static function contacto() {
            echo "Desde el controlador de páginas";
        }
    }