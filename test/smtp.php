<?php

require_once "vendor/autoload.php";

$mail = new Sarps\Mailer\Mailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "esarpong51@@gmail.com";                 
$mail->Password = "xzquschuzqffkwcu";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "esarpong51@gmail.com";
$mail->FromName = "Sarps Test Framework";

$mail->addAddress("esarpong51@gmail.com");

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->loadBodyFromView('achiever', [
    'fname' => 'Sarpi'
]);
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}