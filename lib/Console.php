<?php

namespace Sarps;

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

/**
* @author  Emmanuel Oppong-Sarpong
* @since   February 8, 2019
* @link    https://github.com/Sarps/bulk-mailer
* @version 1.0.0
*/

class Console extends CLI
{

    protected function setup(Options $options)
    {
        $options->registerOption('version', 'print version', 'v');
    }

    protected function main(Options $options)
    {
        if ($options->getOpt('version')) {
            return $this->info('1.0.0');
        }
    }

}