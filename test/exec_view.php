<?php

    ob_start();

    $dummy = array(
        'fname' => 1,
        'b' => 2
    );

    $string = array_map(function ($key, $value) {
        return "$$key=".json_encode($value).";";
    }, array_keys($dummy), $dummy);

    $string = implode($string);

    eval($string);

    include __DIR__.'/../views/achiever.php';
    $out = ob_get_clean();

    //echo 'hello';
    var_dump($out);
    die();
