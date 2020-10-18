<?php

require __DIR__ . '/vendor/autoload.php';

define("ROOT", __DIR__);

\Sarps\Rocket::app()
    ->boot();