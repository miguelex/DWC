<?php 

    namespace MVC;
    class Router {

        public $rutasGET = [];
        public $rutasPOST = [];

        public function get($url, $fn){
            $this->rutasGET[$url] = $fn;
        }
        
        public function comprobarRutas(){
            $urlActual = $_SERVER['PATH_INFO'] ?? '/';
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ( $metodo === 'GET'){
                $fn = $this->rutasGET[$urlActual] ?? null;
            } else {
                $fn = $this->rutasPOST[$urlActual] ?? null;
            }

            if ($fn){
                call_user_func($fn, $this);
            } else {
                echo 'Página no encontrada';
            }
        }

        // Muestra una vista

        public function render($view){
            ob_start();
            include __DIR__ . "/views/$view.php";
            $contenido = ob_get_clean();
            
            include __DIR__ . "/views/layout.php";
        }
    }