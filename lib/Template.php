<?php

namespace App;

use Sarps\Logger\Logger;
use Sarps\Logger\Moby as MobyLogger;
use Sarps\Logger\Email as EmailLogger;
use Sarps\Logger\FrontDesk as FrontDeskLogger;
use Sarps\Logger\NewsLetter as NewsLetterLogger;
use Sarps\Logger\OnlineBanking as OnlineBankingLogger;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mail-scheduler
* @version 1.0.0
*/

class AppTemplate extends \Sarps\BaseApp {

    protected $view = "example";

    protected $subject = "Example Subject";

    protected $data = array();

    protected $mails = array ();

    public function __construct()
    {
        parent::__construct();

        //Your code goes here
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