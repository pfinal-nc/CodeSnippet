<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/6
 * Email: <lampxiezi@163.com>
 */
// 创建TCP服务器
// Server对象 监听 9501端口
$serv = new swoole_server("127.0.0.1", 9501);

// 监听连接进入事件
$serv->on('connect', function ($serv, $fd) {
    echo "Client Connect" . PHP_EOL;
});
// 监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: " . $data);
});
// 监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client Close" . PHP_EOL;
});
// 启动服务器
$serv->start();