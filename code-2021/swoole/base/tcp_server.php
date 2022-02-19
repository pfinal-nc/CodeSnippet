<?php
/**
 * @author pfinal南丞
 * @date 2021年07月13日 下午2:43
 */

// 创建Server对象 监听 127.0.0.1
$server = new Swoole\Server('127.0.0.1', 9501);

// 监听连接进入事件
$server->on('Connect', function ($server, $fd) {
    echo "Client: Connect.\n";
});

// 监听数据接收事件
$server->on('Receive', function ($server, $fd, $reactor_id, $data) {
    $server->send($fd, "Server: {$data}");
});

// 监听链接关闭事件
$server->on('Close', function ($server, $fd) {
    echo "Client: Close.\n";
});

// 启动服务器
$server->start();