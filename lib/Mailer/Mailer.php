<?php

/**
* Logger - Simple PHP mailing class.
*/

namespace Sarps\Mailer;

use \PHPMailer\PHPMailer\PHPMailer;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mailer
* @version 1.0.0
*/

class Mailer extends PHPMailer {

    protected $rootFolder = __DIR__ . "/../../app/views";

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
        require "{$this->rootFolder}/{$view}.php";
        $this->Body = ob_get_clean();
        
    }
}
