<?php 

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use PHPMailer\PHPMailer\PHPMailer;
    use Dotenv\Dotenv;


    class PaginasController {

        public static function index(Router $router) {

            $propiedades = Propiedad::get(3);
            $inicio = true;
            $router->render('paginas/index', [
                'propiedades' => $propiedades,
                'inicio' => $inicio
            ]);
        }

        public static function nosotros(Router $router) {
            $router->render('paginas/nosotros', []);
        }

        public static function propiedades(Router $router) {

            $propiedades = Propiedad::all();
            $router->render('paginas/propiedades', [
                'propiedades' => $propiedades
            ]);
        }

        public static function propiedad(Router $router) {

            $id = validarORedireccionar('/propiedades');

            $propiedad = Propiedad::find($id);

            $router->render('paginas/propiedad', [
                'propiedad' => $propiedad
            ]);
        }

        public static function blog(Router $router) {
            $router->render('paginas/blog', [
                
            ]);
        }

        public static function entrada(Router $router) {
            $router->render('paginas/entrada', [
                
            ]);
        }

        public static function contacto(Router $router) {

            $mensaje = null;

            $dotenv = Dotenv::createImmutable('../');
            $dotenv->load();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $respuesta = $_POST['contacto'];
                
                // Crear instancia de PHPMailer

                $mail = new PHPMailer();

                // Configurar SMTP

                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = $_ENV['USERNAME'];
                $mail->Password = $_ENV['PASSWORD'];
                $mail->SMTPSecure = 'tls';

                // Configurar el contenido del email

                $mail->setFrom('admin@bienesraices.com');
                $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
                $mail->Subject = 'Tienes un nuevo mensaje';

                // Habilitar HTML
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                // Definir el contenido del email

                $contenido = '<html>';
                $contenido .= '<p>Tienes un nuevo mensaje</p>';
                $contenido .= '<p>Nombre: '. $respuesta['nombre'] .'</p>';

                // Enviar de forma condicional algunos campso de email o telefono

                if($respuesta['contacto'] === 'telefono') {
                    $contenido .= '<p>Eligio ser contactado por teléfono</p>';
                    $contenido .= '<p>Teléfono: '. $respuesta['telefono'] .'</p>';
                    $contenido .= '<p>Fecha de contacto: '. $respuesta['fecha'] .'</p>';
                $contenido .= '<p>Hora de contacto: '. $respuesta['hora'] .'</p>';
                } else {
                    $contenido .= '<p>Eligio ser contactado por email</p>';
                    $contenido .= '<p>Email: '. $respuesta['email'] .'</p>';
                }
                $contenido .= '<p>Mensaje: '. $respuesta['mensaje'] .'</p>';
                $contenido .= '<p>Vende o compra: '. $respuesta['tipo'] .'</p>';
                $contenido .= '<p>Precio o presupuesto: $'. $respuesta['precio'] .'</p>';
                
                $contenido .= '</html>';

                $mail->Body = $contenido;
                $mail->AltBody = 'Texto sin formato HTML';

                //Enviar el email

                if($mail->send()){
                    $mensaje = "Mensaje enviado";
                } else {
                    $mensaje = "Error";
                }

            }
            $router->render('paginas/contacto', [
                'mensaje' => $mensaje
            ]);
        }
    }