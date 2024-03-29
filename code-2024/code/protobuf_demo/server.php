<?php
/**
 * Author: PFinal南丞
 * Date: 2024/3/29
 * Email: <lampxiezi@163.com>
 */

namespace ProtobufDemo;
require_once __DIR__ . '/vendor/autoload.php';

use Lotteryservice\GreeterClient;
use Lotteryservice\lotteryReq;


class Server
{
    public function StreamService(): GreeterClient
    {
        return new GreeterClient('127.0.0.1:50051', ['credentials' => \Grpc\ChannelCredentials::createInsecure()]);
    }
}

$server        = new Server();
$serverClient  = $server->StreamService();
$streamRequest = new lotteryReq();
$streamRequest->setParam('{"一等奖": 10,"二等奖":20,"三等奖":30,"四等奖":40}');
$streamResponse = $serverClient->lottery($streamRequest)->wait();
list($reply, $status) = $streamResponse;
# $data = $reply->getData();
var_dump($reply);
# var_dump($status);