<?php


namespace Sarps;


use Sarps\Kernels\CLIKernel;
use Sarps\Kernels\HttpKernel;
use Symfony\Component\Dotenv\Dotenv;
use Weevers\Path\Path;

class Rocket
{

    static function app() {
        $dotenv = new Dotenv();
        $dotenv->load(Path::resolve(ROOT, '.env'));
        return new Rocket();
    }

    function boot()
    {
        return 'cli' == php_sapi_name() ? CLIKernel::boot() : HttpKernel::boot();
    }

    static function bootCLI() {
        CLIKernel::boot();
    }

    static function bootHttp() {
        HttpKernel::boot();
    }
}