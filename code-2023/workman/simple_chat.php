<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/12
 * Email: <lampxiezi@163.com>
 */
use Workerman\Worker;
use Workerman\Connection\TcpConnection;
require_once __DIR__ . '/../vendor/autoload.php';
$global_uid = 0;

// 当客户端连上来时分配uid, 并保存链接, 并通知所有客户端
function handle_connection($connection): void
{
    global $text_worker, $global_uid;
    // 为这个链接分配一个uid
    $connection->uid = ++$global_uid;
}

// 当客户端发送消息过来时, 转发给所有人
function handle_message($connection, $data): void
{
    global $text_worker;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] said: $data");
    }
}

// 当客户端断开时, 广播给所有客户端
function handle_close($connection): void
{
    global $text_worker;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] logout");
    }
}

// 创建一个文本协议的Work 监听2347 接口
$text_worker = new Worker("text://0.0.0.0:2347");

// 只启动1个进程, 这样方便客户端之前传输数据
$text_worker->count = 1;
$text_worker->onConnect = 'handle_connection';
$text_worker->onMessage = 'handle_message';
$text_worker->onClose   = 'handle_close';

// 启动
Worker::runAll();