<?php

namespace App\Mailer;

use Sarps\Logger\Logger;
use App\Logger\AppTemplate as AppTemplateLogger;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mailer
* @version 1.0.0
*/

class AppTemplate extends \Sarps\BaseApp {

    protected $view = "ViewName";

    protected $subject = "Example Subject";

    protected $data = array();

    protected $mails = array (
        "receipient1@example.com",
        "receipient2@example.com",
    );

    public function __construct()
    {
        parent::__construct();

        //Your code goes here

    }

    public function meailingStartCallback()
    {
        //$this->warning('AppTemplate mailing started, make sure you have good internet connection');
    }

    public function mailSentCallback($index, $email, $data)
    {
        //$logger = new AppTemplateLogger;
        //$logger->log('sent', $email, json_encode($data) );
    }

    public function mailFailedCallback($index, $email, $data)
    {
        //$logger = new AppTemplateLogger;
        //$logger->log('not sent', $email, json_encode($data));
    }

    public function mailingCompleteCallback()
    {
        //$this->success('AppTemplate mailing complete. Check the logs, if any, to verify all mails sent');
    }

}