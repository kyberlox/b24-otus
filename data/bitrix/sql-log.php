<?php 

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Loader;

$APPLICATION -> setTitle('b24-sql-log');


Loader::includeModule('iblock');
Loader::includeModule('crm');

\Bitrix\Main\Application::getConnection()->startTracker();

$result = \Bitrix\Iblock\ElementTable::getList([
    'filter' => [
        'IBLOCK_ID' => 1,
    ],
    'select' => [
        'ID'
    ],
]);

\Bitrix\Main\Application::getConnection()->stopTracker();
\Bitrix\Main\Diag\Debug::dump($result->getTrackerQuery()->getSql());

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';

?>