<?php
/**
 * @author pfinal南丞
 * @date 2021年07月13日 下午3:43
 */

// 创建WebSocket Server 对象 监听 0.0.0.0:9502 端口
$ws = new Swoole\WebSocket\Server('0.0.0.0', 9502);

// 监听WebSocket 消息事件
$ws->on('Message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

// 监听WebSocket 连接关闭事件
$ws->on('Close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});
$ws->start();
