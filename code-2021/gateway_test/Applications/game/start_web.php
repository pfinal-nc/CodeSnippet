<?php

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
use Workerman\Worker;

/**
 * @Author: PFinal南丞
 * @Email: lampxiezi@163.com
 * @Date:   2021-04-12 14:11:46
 * @Last Modified time: 2021-04-12 15:33:24
 */

require_once __DIR__ .'/../../vendor/autoload.php';

// WebServer
$web = new Worker("http://0.0.0.0:8383");
// WebServer数量
$web->count = 2;

$web->name = 'web';


define('WEBROOT', __DIR__ . DIRECTORY_SEPARATOR .  'Web');

$web->onMessage = function (TcpConnection $connection, Request $request) {
    $path = $request->path();
    if ($path === '/') {
        $connection->send(exec_php_file(WEBROOT.'/index.php', $request));
        return;
    }
    $file = realpath(WEBROOT. $path);
    if (false === $file) {
        $connection->send(new Response(404, array(), '<h3>404 Not Found</h3>'));
        return;
    }
    // Security check! Very important!!!
    if (strpos($file, WEBROOT) !== 0) {
        $connection->send(new Response(400));
        return;
    }
    if (\pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $connection->send(exec_php_file($file), $request);
        return;
    }

    $if_modified_since = $request->header('if-modified-since');
    if (!empty($if_modified_since)) {
        // Check 304.
        $info = \stat($file);
        $modified_time = $info ? \date('D, d M Y H:i:s', $info['mtime']) . ' ' . \date_default_timezone_get() : '';
        if ($modified_time === $if_modified_since) {
            $connection->send(new Response(304));
            return;
        }
    }
    $connection->send((new Response())->withFile($file));
};

function exec_php_file($file, $request) {
    \ob_start();
    // Try to include php file.
    try {
        include $file;
    } catch (\Exception $e) {
        echo $e;
    }
    return \ob_get_clean();
}


// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}