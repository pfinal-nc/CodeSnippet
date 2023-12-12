<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/12
 * Email: <lampxiezi@163.com>
 */
// 进程重启后id编号值是不变的。
// 进程编号Id 的分配是基于每个worker实例的。每个worker 实例都从0开始给自己的进程编号, 所以worker实例间进程编号会有重复, 但是一个 worker 实例中的进程编号不会重复
require_once __DIR__ . '/../vendor/autoload.php';
use Workerman\Worker;
$worker1 = new Worker('tcp://0.0.0.0:8585');
// 设置启动4个进程
$worker1->count = 4;
// 每个进程启动后打印当前进程id编号即 $worker1->id
$worker1->onWorkerStart = function($worker1)
{
    echo "worker1->id={$worker1->id}\n";
};

// worker实例2有两个进程，进程id编号将分别为0、1
$worker2 = new Worker('tcp://0.0.0.0:8686');
// 设置启动2个进程
$worker2->count = 2;
// 每个进程启动后打印当前进程id编号即 $worker2->id
$worker2->onWorkerStart = function($worker2)
{
    echo "worker2->id={$worker2->id}\n";
};

// 运行worker
Worker::runAll();

// count 设置当前 worker 实例启动多少个进程, 不设置默认为1 此属性必须在 Worker::runAll() 方法前设置才有效,
// $worker->name  name 属性可以设置worker 实例的名称, 方便运行status 命令时识别进程 不设置默认为 none
// $worker->protocol 设置当前 worker 实例使用的通讯协议, 默认为 text, 即文本协议, 也可以设置为 binary 二进制协议
/**
 * use Workerman\Worker;
 * use Workerman\Connection\TcpConnection;
 * require_once __DIR__ . '/vendor/autoload.php';
 *
 * $worker = new Worker('tcp://0.0.0.0:8686');
 * $worker->protocol = 'Workerman\\Protocols\\Http';
 *
 * $worker->onMessage = function(TcpConnection $connection, $data)
 * {
 * var_dump($_GET, $_POST);
 * $connection->send("hello");
 * };
 *
 * // 运行worker
 * Worker::runAll();
 */

// $connections 属性中存储了当前进程的所有客户端连接对象, 其中id为connection的id编号


