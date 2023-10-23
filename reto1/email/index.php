<?php
require_once("../assets/includes/DB.php"); 
require_once("../assets/includes/funciones.php"); 
require_once("../assets/includes/sesiones.php"); 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);   
$nick =  $_SESSION["nickemail"];
$mailuser = $_SESSION["emailemail"];     

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'danielsou9782@gmail.com';                     //SMTP username
    $mail->Password   = 'FV48Nyvw3MY6RU0A';                               //SMTP password
    //$mail->SMTPSecure =   "tls";            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // //Recipients
    $mail->setFrom('grupo1reto1@proton.me', 'Grupo 1');
    // $mailuser, $nick
    $mail->addAddress('danielsou9782@gmail.com', "daniel");     //Add a recipient
    $mail->addReplyTo('grupo1reto1@proton.me', 'Grupo 1');

    // //Attachments
    // $mail->addAttachment('../assets/img/emailvalidado.png');         //Add attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Felicitaciones! Cuenta Validada (Grupo 1)';
    $mail->Body    = file_get_contents('email.html');
    $mail->AltBody = 'Tu Cuenta ha sido validada, Ya puedes Iniciar sesion <b>Felicidades!</b>';

    $mail->send();
    echo 'Se ha enviado al usuario el correo de confirmacion! <a href="../views/dashboard.php">Volver al dashboard</a>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>