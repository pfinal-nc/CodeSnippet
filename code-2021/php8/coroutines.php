<?php
/**
 * @author pfinal南丞
 * @date 2021年07月12日 下午6:56
 */

# logger() 协程

function logger($fileName)
{
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        fwrite($fileHandle, yield . "\n");
    }
}
$logger = logger(__DIR__ . '/log');
$logger->send('Foo');
$logger->send('Bar');