<?php


namespace Sarps\Kernels;

include ROOT . '/src/routes.php';

class HttpKernel extends BaseKernel
{
    static function boot()
    {
        parent::boot();
        var_dump(\Sarps\Route::attributes());
    }

}