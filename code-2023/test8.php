<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/5
 * Email: <lampxiezi@163.com>
 */

use Swoole\Coroutine\Channel;
use function Swoole\Coroutine\{go, run};

run(function() {
    $chan = new Channel(5);
    go(function () use ($chan) {
        $cli = new Swoole\Coroutine\Http\Client('www.qq.com', 80);
        $ret = $cli->get('/');
        $chan->push(['key' => 'www.qq.com', 'content' => '访问www.qq.com成功！']);
    });

    go(function () use ($chan) {
        $cli = new Swoole\Coroutine\Http\Client('www.163.com', 80);
        $ret = $cli->get('/');
        $chan->push(['key' => 'www.163.com', 'content' => '访问www.qq.com成功！']);
    });
    for ($i = 0; $i < 2; $i++) {
        $result = $chan->pop();
        print_r($result);
    }
});