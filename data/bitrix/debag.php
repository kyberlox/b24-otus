<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

// Абсолютный путь к корню сайта
define('DOCUMENT_ROOT', '/var/www');

// Включение максимального уровня ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Проверка существования ядра
$corePath = DOCUMENT_ROOT.'/bitrix/bitrix/modules/main/include/prolog_before.php';
if (!file_exists($corePath)) {
    die("Ядро не найдено по пути: ".$corePath."<br>Проверьте структуру каталогов");
}

// Проверка прав доступа
if (!is_readable($corePath)) {
    $perms = substr(sprintf('%o', fileperms($corePath)), -4);
    die("Нет доступа к ядру. Права: ".$perms."<br>Требуются права 644 или 755");
}

// Подключение ядра с обработкой ошибок
try {
    require_once $corePath;
    \Bitrix\Main\Diag\Debug::dump( "Ядро Bitrix успешно подключено! ");
    
    // Дополнительные проверки
    if (!defined('B_PROLOG_INCLUDED')) {
        die("Константа B_PROLOG_INCLUDED не определена");
    }
    
    // Проверка версии
    
    \Bitrix\Main\Diag\Debug::dump( " <br>Версия Bitrix: ".SM_VERSION );
    
} catch (Throwable $e) {
    die("Ошибка при подключении ядра:<br><pre>".htmlspecialchars($e)."</pre>");
}



//Домашка

$APPLICATION -> setTitle('b24-logs');

$APPLICATION -> setTitle('Пример отладки');
\Bitrix\Main\Diag\Debug::dump([1, 2, 3, 4]);

$now = new DateTime();

\Bitrix\Main\Diag\Debug::dumpToFile($now, 'b24-otus-logs.log');

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';