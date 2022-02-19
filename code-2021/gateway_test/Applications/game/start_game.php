<?php

use Workerman\Worker;
use \GatewayWorker\Gateway;

/**
 * @Author: PFinal南丞
 * @Email: lampxiezi@163.com
 * @Date:   2021-04-12 11:47:08
 * @Last Modified time: 2021-04-12 15:46:33
 */
require_once __DIR__ . '/../../vendor/autoload.php';

$gateway = new Gateway("Websocket://0.0.0.0:2347");

$gateway->name = 'TodpoleGateway';

// 只启动1 个进程
$gateway->count = 1;

$gateway->user_data = array();

$gateway->registerAddress = '127.0.0.1:1237';

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}