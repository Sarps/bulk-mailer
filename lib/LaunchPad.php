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

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mailer
* @version 1.0.0
*/

class LaunchPad extends Console {

    protected $mail;
    protected $subject;
    protected $view;

    public function __construct()
    {
        parent::__construct();
    }

    public function sendBulkMail()
    {
        $index = 0;
        $mail = $this->getMail(0);
        $data = $this->getData(0);

        $this->mailingStartCallback();

        while ( $mail ) {

            $index++;
            $this->info("Sending {$index} to {$mail}");

            if ( gettype($data) != "array" ) {
                
                if ($data == false) {
                    return $this->error('Insufficient data to continue operation');
                }

                return $this->error('Data in "$data" must be at least, 2-dimensional array or that returned by "getData($index) must be at least 1-dimensional"');
            }

            if( $this->sendMail($mail, $data) ) {
                $this->mailSentCallback($index-1, $mail, $data);
            } else {
                $this->mailFailedCallback($index-1, $mail, $data);
            }

            sleep(2);

            $mail = $this->getMail($index);
            $data = $this->getData($index);
        }

        $this->mailingCompleteCallback();

    }

    public function sendMail($email, $data)
    {
        $mail = new Mailer;
        $mail->From = getenv('FROM_MAIL');
        $mail->FromName = getenv('FROM_NAME');
        $mail->isHTML( getenv('IS_HTML') );
        
        $mail->addAddress($email);
        $mail->Subject = $this->getSubject();
        $mail->loadBodyFromView($this->getView(), $data);
        
        if ( getenv('IS_SMTP') == 'true') {

            $mail->isSMTP();
            
            $mail->Host = getenv('SMTP_HOST');
            $mail->SMTPAuth = getenv('SMTP_AUTH');  
            $mail->Username = getenv('SMTP_USER');          
            $mail->Password = getenv('SMTP_PASS');
            $mail->SMTPSecure = getenv('SMTP_SECURE');
            $mail->Port = getenv('TCP_PORT');
                                             
        }

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

    public function mailingStartCallback()
    {
        
    }

    public function mailSentCallback($index, $email, $data)
    {

    }

    public function mailFailedCallback($index, $email, $data)
    {

    }

    public function mailingCompleteCallback()
    {
        
    }

    public function __desconstruct()
    {
        
    }

}