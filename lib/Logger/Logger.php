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

class Logger {
    /**
    * $log_file - path and log file name
    * @var string
    */
    protected $rootFolder = __DIR__."/../../logs";
    /**
    * $file - file
    * @var string
    */
    protected $file;

    /**
    * Class constructor
    * @param string $log_file - path and filename of log
    * @param array $params
    */
    public function __construct($log_type = 'Logs', $params = array()) {

        date_default_timezone_set('UTC');
	    $this->logFileDate = date('Y-m-d');
	    $this->logTime = date('Y-m-d H:i:s');
        
        $this->type = $log_type;
        $this->params = $params;
        
        $this->openLog();
    }

    /**
    * Parse the parameter for writing to log file
    * @return string
    */
    public function prepareLog() {
        $log = "";
		foreach ($this->params as $key => $value) {
            $log .= "|| $key :: $value ";
        }
        $log = "{$this->logTime} {$log}\n";
        return $log;
    }

    /**
    * Write to log file
    * @return void
    */
    public function writeLog() {
        if (!is_resource($this->file)) {
            $this->openLog();
        }
	    fwrite($this->file, $this->prepareLog());
    }

    /**
    * Open log file
    * @return void
    */
    private function openLog(){
        $logFile = "{$this->rootFolder}/{$this->type}-{$this->logFileDate}.log";
        $this->file = fopen($logFile, 'a') or die("Can't create log");
        if(!is_writable($logFile)) {
            throw new Exception("ERROR: Unable to write to file!", 1);
        }
    }

    /**
     * Class destructor
     */
    public function __destruct(){
        if ($this->file) {
            fclose($this->file);
        }
    }
}