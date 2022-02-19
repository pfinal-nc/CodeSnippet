<?php

use GatewayWorker\Register;
use Workerman\Worker;

/**
 * @Author: PFinal南丞
 * @Email: lampxiezi@163.com
 * @Date:   2021-04-12 14:33:50
 * @Last Modified time: 2021-04-12 14:34:35
 */
require_once __DIR__ . '/../../vendor/autoload.php';

$register = new Register('text://0.0.0.0:1237');

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}
