<?php

namespace App;

use Sarps\Mailer\Mailer;

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

class ExampleApp extends \Sarps\BaseApp {

    protected $view = "example";

    protected $subject = "Test Run";

    protected $data = array(
        array("app_name" => "ExampleApp")
    );

    protected $mails = array (
        "esarpong51@gmail.com",
    );

    public function getData($index)
    {
        return array("app_name" => "ExampleApp{$index}");
    }

    public function messagingStartCallback()
    {
        //$this->warning('Messaging started, make sure you have good internet connection');
    }

    public function messageSentCallback($index, $email, $data)
    {
        //$logger = new EmailLogger;
        //$logger->log($index, $email, 'ENTERPRISE', 'sent');
    }

    public function messageFailedCallback($index, $email, $data)
    {
        //$logger = new EmailLogger;
        //$logger->log($index, $email, 'ENTERPRISE', 'not sent');
    }

    public function messagingCompleteCallback()
    {
        //$this->success('Messaging completed, please check to verify all mails sent');
    }

}