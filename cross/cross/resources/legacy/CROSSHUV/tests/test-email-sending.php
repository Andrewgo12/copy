<?php

/*error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

require_once "/usr/share/pear/Mail.php";
$host = "ssl://smtp.gmail.com";
$username = "cazapata@fullengine.com";
$password = "Jodaca.2013";
$port = "465";
$to = "cazapata@fullengine.com";
$email_from = "cazapata@fullengine.com";
$email_subject = "Línea de asunto aquí:";
$email_body = "Lo que tu quieras";
$email_address = "gerente@fullengine.com";

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
} 
else {
   echo("<p>Message successfully sent!</p>");
}
*/
include('SMTPClass.php');
//Dirección del servidor
//$SmtpServer = '127.0.0.1';
//$SmtpPort = '25'; // predeterminado
//$SmtpUser = 'root';
//$SmtpPass = '@dm1nhuv';
$SmtpServer = 'smtp.gmail.com';
$SmtpPort = '465'; // predeterminado
$SmtpUser = 'cazapata@fullengine.com';
$SmtpPass = 'bren.97D';


$to = 'cazapata@fullengine.com';
$from = 'cazapata@fullengine.com';
$subject = 'Prueba de correo';
$body = 'Esta es una prueba';
$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
$SMTPChat = $SMTPMail->SendMail();



?>
