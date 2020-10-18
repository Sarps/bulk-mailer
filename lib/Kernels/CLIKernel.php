<?php


namespace Sarps\Kernels;

use Sarps\Providers\CLIRunner;

class CLIKernel extends BaseKernel
{
    static function boot()
    {
        parent::boot();
        $cli = new CLIRunner();
        $cli->run();
    }

}