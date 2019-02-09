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

class AppTemplate extends \Sarps\BaseApp {

    protected $view;
    protected $subject;
    protected $data;
    protected $rule;

    public function callback()
    {

    }

    public function run($from)
    {
        
    }

    public function mail($email)
    {
        
    }

}