<?php 

namespace Controllers;
use MVC\Router;
use Model\Blog;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class BlogController {

    public static function index(Router $router) {
        $blog = Blog::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('blog/index', [
            'entradas' => $blog,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear (Router $router)
    {
        $blog = new Blog;
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores

        $errores = Blog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blog = new Blog($_POST['blog']);

            // Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Realiza el resize a la imagen

            if ($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen, CARPETA_BLOG);
            }

            $errores = $blog->validar();

            if (empty($errores)) {

                // Crear la carpeta para subir imagenes

                if (!is_dir(CARPETA_BLOG)) {
                    mkdir(CARPETA_BLOG);
                }

                // Guardar la imagen en el servidor
                $image->save(CARPETA_BLOG . $nombreImagen);

                // Guardar en BD

                $blog->guardar();
            }
        }

        $router->render('blog/crear', [
            'blog' => $blog,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar (Router $router)
    {
        $id = validarORedireccionar('/admin');

        $blog = Blog::find($id);
        $vendedores = Vendedor::all();

        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            
            // Asignar los valores
            $args = $_POST['blog'];
        
            $blog->sincronizar($args);
        
            // Validacion
            $errores = $blog->validar();    
        
            //Subida de imagenes
        
            // Generar nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            // Realiza el resize a la imagen
            
            if($_FILES['blog']['tmp_name']['imagen']){
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                $blog->setImagen($nombreImagen, CARPETA_BLOG);
            }
        
            if(empty($errores)){
                if($_FILES['blog']['tmp_name']['imagen']) {
                    $image->save(CARPETA_BLOG . $nombreImagen);
                }
                
                $blog->guardar();
            }    
        
        }

        $router->render('blog/actualizar', [
            'blog' => $blog,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar (Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            if($id){
        
                $tipo = $_POST['tipo'];
        
                if (validarTipoContenido($tipo)){
                    $blog = Blog::find($id);
                    $blog->eliminar(CARPETA_BLOG);
                }
            }
        }
    }
}