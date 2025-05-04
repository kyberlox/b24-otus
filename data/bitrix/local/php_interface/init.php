<?php

define("DEBUG_FILE_NAME","/logs/exception.log");

if (file_exists(__DIR__.'/classes/autoload.php')) {
    require_once __DIR__.'/classes/autoload.php'
};

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php'
};

Bitrix\Main\Extension::load(['popup', 'crm.currency', 'timeman.custom']);