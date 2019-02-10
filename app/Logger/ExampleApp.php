<?php

/**
* Logger - Simple PHP logging class.
*/

namespace App\Logger;

use Sarps\Logger\Logger;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mailer
* @version 1.0.0
*/

class ExampleApp extends Logger {

    public function __construct()
    {
        parent::__construct('ExampleAppLogs');
    }

    /**
     * Specify the parameter that require logging
     * Example below will write logs in the format below: 
     * 2019-02-08 00:00:00 || KEY1 :: $vlaue1 || KEY2 :: $value2 || KEY3 :: $value3
     * @return Array
     */
    public function format($value1, $value2, $value3)
    {
        return array (
            'KEY1' => $value1,
            'KEY2' => $value2,
            'KEY3' => $value3
        );
    }

}