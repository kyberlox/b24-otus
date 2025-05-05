<?php

define("DEBUG_FILE_NAME","/logs/exception.log");

if (file_exists(__DIR__.'/classes/autoload.php')) {
    require_once __DIR__.'/classes/autoload.php';
};

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
};

// вывод данных
function pr($var, $type = false) {
    echo '<pre style="font-size:15px; border:1px solid #000; background:#FFF; text-align:left; color:#0057fa;">';
    if ($type)
        var_dump($var);
    else
        print_r($var);
    echo '</pre>';
}

