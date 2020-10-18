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
    }

    static function bootCLI() {
        CLIKernel::boot();
    }

    static function bootHttp() {
        HttpKernel::boot();
    }
}