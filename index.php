<?php

require_once __DIR__ . '/bootstrap.php';
\Sarps\Rocket::bootHttp();

var_dump(\Sarps\Route::attributes());

//$response->setStatusCode(404);
//$response->setContent('Not Found');

//$response->send();