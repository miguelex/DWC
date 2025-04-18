<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {// Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '309d55bb883dee';
        $mail->Password = 'de7771f553b2ac';
        $mail->setFrom('cuentas@appsalon.com', 'AppSalon');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon');
        $mail->Subject = 'Confirma tu cuenta';
        
        $contenido = "<htnml>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona <a href='http://localhost:8000/confirmar-cuenta?token=" . $this->token . "'>aqui</a> para confirmar tu cuenta</p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '309d55bb883dee';
        $mail->Password = 'de7771f553b2ac';
        $mail->setFrom('cuentas@appsalon.com', 'AppSalon');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon');
        $mail->Subject = 'Reestablece tu password';
        
        $contenido = "<htnml>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password</p>";
        $contenido .= "<p>Presiona <a href='http://localhost:8000/recuperar?token=" . $this->token . "'>aqui</a> para reestablecer tu password</p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $contenido;
        $mail->send();
    }
}