<?php

use GatewayWorker\BusinessWorker;
use Workerman\Worker;

/**
 * @Author: PFinal南丞
 * @Email: lampxiezi@163.com
 * @Date:   2021-04-12 15:34:26
 * @Last Modified time: 2021-04-12 15:35:05
 */

require_once __DIR__ .'/../../vendor/autoload.php';

// bussinessWorker 进程
$worker = new BusinessWorker();
// worker名称
$worker->name = 'TodpoleBusinessWorker';
// bussinessWorker进程数量
$worker->count = 4;
// 服务注册地址
$worker->registerAddress = '127.0.0.1:1237';

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}