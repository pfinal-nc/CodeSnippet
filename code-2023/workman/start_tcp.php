<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/12
 * Email: <lampxiezi@163.com>
 */
require_once __DIR__ . '/../vendor/autoload.php';

// 创建一个 worker 监听2347端口, 不使用任何应用层协议
/** @noinspection PhpObjectFieldsAreOnlyWrittenInspection */
$tcp_worker = new \Workerman\Worker('tcp://0.0.0.0:2347');

// 启动4个进程对外提供服务
$tcp_worker->count = 4;

// 当收到客户端发来的数据后返回hello $data给客户端
$tcp_worker->onMessage = function (\Workerman\Connection\TcpConnection $connection, $data) {
    // 向客户端发送hello $data
    $connection->send('hello ' . $data);
};


// 运行worker
Workerman\Worker::runAll();