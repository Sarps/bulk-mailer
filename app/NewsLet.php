<?php

/**
* Logger - Simple PHP mailing class.
*/

namespace App;

use Sarps\Mailer\Mailer;
use Sarps\Logger\Logger;
use Sarps\Scheduler\Scheduler;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mail-scheduler
* @version 1.0.0
*/

class NewsLet {

    public function __construct()
    {
        
    }

    public function data()
    {
        
    }

    public function view()
    {
        
    }

    public function rule()
    {
        
    }

    public function callback()
    {

    }

    public function run($from)
    {
        
    }

    public function mail($email)
    {
        $mail = new Mailer;

        $mail->isSMTP();            
                         
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;  
        $mail->Username = "esarpong51@@gmail.com";                 
        $mail->Password = "xzquschuzqffkwcu";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;                                   

        $mail->From = "esarpong51@gmail.com";
        $mail->FromName = "Sarps Test Framework";

        $mail->addAddress($email);

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
    }

    public function __desconstruct()
    {
        
    }

}