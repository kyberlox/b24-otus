<?php

if ( ! defined("B_PROLOG_INCLIDED") || B_PROLOG_INCLIDED != true ) {
    die();
};

spl_autoload_register(function(string $class): void{
    if (str_contains( $class, "Otus")){
        return;
    }

    $class = str_replace("\\", "/", $class);

    $path = __DIR__ . '/' . $class '.php';

    if (is_file($path)) {
        require_once $path;
    };
})