<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/12
 * Email: <lampxiezi@163.com>
 */
use Workerman\Worker;
use Workerman\Connection\TcpConnection;

require_once '../vendor/autoload.php';

$ws_worker = new Worker("websocket://0.0.0.0:8001");

// 启动4个进程对外提供服务
$ws_worker->count = 4;

// 当收到客户端发来的数据后返回hello $data给客户端
$ws_worker->onMessage = function(TcpConnection $connection, $data)
{
    // 向客户端发送hello $data
    $connection->send('hello ' . $data);
};

// 运行worker
Worker::runAll();