<?php

    namespace App;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email {

        public $email;
        public $nombre;
        public $token;

        public function __construct($email, $nombre, $token)
        {
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
        }

        public function enviarConfirmacion(){
            //Crear el objeto de email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '5b8f1f839b139a';
            $mail->Password = 'b48fe8e7b1757b';

            $mail->setFrom('cuentas@blogpeliculas.com');
            $mail->addAddress('cuentas@blogpeliculas.com', 'BlogPeliculas.com');
            $mail->Subject = 'Confirma tu cuenta';

            //Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado
            tu cuenta en Blog Peliculas, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido .= "<p>Presiona Aqui: <a href='http://localhost/BlogPeliculas/confirmar-cuenta.php?token=" 
            . $this->token . "'>Confirmar Cuenta</a> </p>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;

            //Enviar el mail
            $mail->send();
        }

        public function enviarInstrucciones(){
            //Crear el objeto de email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '5b8f1f839b139a';
            $mail->Password = 'b48fe8e7b1757b';

            $mail->setFrom('cuentas@blogpeliculas.com');
            $mail->addAddress('cuentas@blogpeliculas.com', 'BlogPeliculas.com');
            $mail->Subject = 'Reestablece tu password';

            //Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado 
            reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
            $contenido .= "<p>Presiona Aqui: <a href='http://localhost/BlogPeliculas/recuperar-password.php?token=" 
            . $this->token . "'>Reestablecer Password</a> </p>";
            $contenido .= "<p>Si tu no solicitaste esta cambio, puedes ignorar el mensaje</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;

            //Enviar el mail
            $mail->send();
        }
    }