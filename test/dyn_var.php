<?php

    $dummy = array(
        'a' => 1,
        'b' => 2
    );

    foreach($dummy as $key => $value) {
        echo "$$key=".json_encode($value).';';
    }

    echo $a;