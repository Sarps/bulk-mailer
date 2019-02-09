<?php

/**
* Logger - Simple PHP mailing class.
*/

namespace Sarps\Mailer;

use \PHPMailer\PHPMailer\PHPMailer;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mail-scheduler
* @version 1.0.0
*/

class Mailer extends PHPMailer {

    protected $rootFolder = __DIR__."/../../views";

    public function __construct()
    {
        parent::__construct();
    }

    public function loadBodyFromView($view, $data = array())
    {
        $string = array_map(function ($key, $value) {
            return "$$key=".json_encode($value).";";
        }, array_keys($data), $data);
    
        $string = implode($string);

        ob_start();
        eval($string);
        include "{$this->rootFolder}/{$view}.php";
        $this->Body = ob_get_clean();
        
    }
}
