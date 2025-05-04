<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION -> setTitle('b24-logs');

$APPLICATION -> setTitle('Пример отладки');
\Bitrix\Main\Diag\Debug::dump([1, 2, 3, 4]);

$now = new DateTime();

\Bitrix\Main\Diag\Debug::dumpToFile($now, 'b24-logs.log');
getSql();

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';

?>