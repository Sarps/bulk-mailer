<?php

/**
* Logger - Simple PHP logging class.
*/

namespace Sarps\Logger;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mail-scheduler
* @version 1.0.0
*/

class Moby extends Logger {

    public function __construct()
    {
        parent::__construct('EmailLogsMoby');
    }

    public function log($email, $status)
    {
        $this->params = array(
            'EMAIL' => $email,
            'STATUS' => $status
        );
        $this->writeLog();
    }

}