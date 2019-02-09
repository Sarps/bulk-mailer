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

class Email extends Logger {

    public function __construct()
    {
        parent::__construct('EmailLogs');
    }

    public function log($cif, $email, $segment, $status)
    {
        $this->params = array(
            'CIF' => $cif,
            'EMAIL' => $email,
            'SEGMENT' => $segment,
            'STATUS' => $status
        );
        $this->writeLog();
    }

}