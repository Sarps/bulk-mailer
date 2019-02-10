<?php

namespace App\Mailer;

use Sarps\Logger\Logger;
use App\Logger\ExampleApp as ExampleAppLogger;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mailer
* @version 1.0.0
*/

class ExampleApp extends \Sarps\BaseApp {

    protected $view = "example";

    protected $subject = "Example Subject";

    protected $data = array(
        array("app_name" => "ExampleApp")
    );

    protected $mails = array (
        "esarpong51@gmail.com",
    );

    public function __construct()
    {
        parent::__construct();

        //Your code goes here

    }

    public function getData($index)
    {
        return array("app_name" => "ExampleApp{$index}");
    }

    public function meailingStartCallback()
    {
        //$this->warning('ExampleApp mailing started, make sure you have good internet connection');
    }

    public function mailSentCallback($index, $email, $data)
    {
        $logger = new ExampleAppLogger;
        $logger->log('sent', $email, json_encode($data) );
    }

    public function mailFailedCallback($index, $email, $data)
    {
        //$logger = new ExampleAppLogger;
        //$logger->log('not sent', $email, json_encode($data));
    }

    public function mailingCompleteCallback()
    {
        //$this->success('ExampleApp mailing complete. Check the logs, if any, to verify all mails sent');
    }

}