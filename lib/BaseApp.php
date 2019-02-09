<?php

namespace Sarps;

use Sarps\Mailer\Mailer;

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

use Sarps\Logger\Logger;
use Sarps\Logger\Moby as MobyLogger;
use Sarps\Logger\Email as EmailLogger;
use Sarps\Logger\FrontDesk as FrontDeskLogger;
use Sarps\Logger\NewsLetter as NewsLetterLogger;
use Sarps\Logger\OnlineBanking as OnlineBankingLogger;

use Sarps\Scheduler\Scheduler;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mail-scheduler
* @version 1.0.0
*/

class BaseApp extends Console {

    protected $mail;
    protected $subject;
    protected $view;

    public function __construct()
    {
        parent::__construct();
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

    public function sendBulkMail()
    {
        $index = 0;
        $mail = $this->getMail(0);
        $data = $this->getData(0);

        $this->messagingStartCallback();

        while ( $mail ) {
            $index++;
            $this->info("Sending {$index} to {$mail}");

            if ($data == false) {
                return $this->error('Insufficient data to continue operation');
            }

            if( $this->sendMail($mail, $data) ) {
                $this->messageSentCallback($index-1, $mail, $data);
            } else {
                $this->messageFailedCallback($index-1, $mail, $data);
            }

            $mail = $this->getMail($index);
            $data = $this->getData($index);
        }

        $this->messagingCompleteCallback();

    }

    public function sendMail($email, $data)
    {
        $mail = new Mailer;

        $mail->isSMTP();            
                         
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;  
        $mail->Username = "esarpong51@gmail.com";                 
        $mail->Password = "xzquschuzqffkwcu";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;                                   

        $mail->From = "esarpong51@gmail.com";
        $mail->FromName = "Sarps Test Framework";

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = $this->getSubject();
        $mail->loadBodyFromView($this->getView(), $data);

        if(!$mail->send()) {
            $this->error("Mailer Error: " . $mail->ErrorInfo);
            return false;
        } 
        $this->success("Message has been sent successfully");
        return true;
    }

    public function getMail($index)
    {
        if($index >= count($this->mails)) {
            return null;
        }
        return $this->mails[$index];
    }

    public function getView()
    {
        return $this->view;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getData($index)
    {
        if($index >= count($this->data)) {
            return false;
        }
        return $this->data[$index];
    }

    public function getRule()
    {
        return $this->rule;
    }

    public function messagingStartCallback()
    {
        
    }

    public function messageSentCallback($index, $email, $data)
    {

    }

    public function messageFailedCallback($index, $email, $data)
    {

    }

    public function messagingCompleteCallback()
    {
        
    }

    public function __desconstruct()
    {
        
    }

}