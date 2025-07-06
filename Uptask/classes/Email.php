<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
   protected $email;
   protected $nombre;
   protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '309d55bb883dee';
        $mail->Password = 'de7771f553b2ac';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress('cuentas@uptask.com', 'uptask.com');
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has creado tu cuenta en Uptask, solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:8000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tuviste problemas haciendo clic en el botón, copia y pega la siguiente URL en tu navegador: </p>";
        $contenido .= "<p>http://localhost:8000/confirmar?token=" . $this->token . "</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        $mail->send();
    }
}
