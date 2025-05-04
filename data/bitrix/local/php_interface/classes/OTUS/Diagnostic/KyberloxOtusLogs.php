<?php

namespace Otus\Diagnostic;

use Bitrix\Main\Diag\FileExcpetionHandlerLog;
use Bitrix\Main\Diag\ExcpetionHandlerFormatter;

class KyberloxLogs extends FileExcpetionHandlerLog;
{
    public function write($exeception, $logType) {
        $text = ExcpetionHandlerFormatter::format($exeception);

        $context = [
            "type"=> static::logTypeString($logType),
        ];

        $lvl = static::logTypeToLavel($logType);
        $msg = "{date} | Host: {host} | type {type} | {$text}\n"
        $lns = explode("\n", $msg);

        foreach ($lns as $ln) {
            $ln = 'OTUS | '.$ln;
        };

        $msg = implode('\n', $lns);
        $this->logger->log($lvl, $msg, $context);
    }
}