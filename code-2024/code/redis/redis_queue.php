<?php
/**
 * Author: PFinal南丞
 * Date: 2024/2/28
 * Email: <lampxiezi@163.com>
 */

# 队列
$redis = new Redis();
try {
    $redis->connect('172.100.0.6');
    $strQueueKey = "test_queue";

    // 进队列
    $redis->rPush($strQueueKey, json_encode(['uid' => 1, 'name' => 'Job1']));
    $redis->rPush($strQueueKey, json_encode(['uid' => 2, 'name' => 'Job2']));
    $redis->rPush($strQueueKey, json_encode(['uid' => 3, 'name' => 'Job3']));
    echo "队列长度：" . $redis->lLen($strQueueKey) . PHP_EOL;

    // 查看队列数据
    $strCount = $redis->lRange($strQueueKey, 0, -1);
    echo "当前队列数据：\n";
    print_r($strCount);

    // 出队列
    $strJob = $redis->lPop($strQueueKey);
    echo "出队列数据：\n";
    print_r($strJob);
    echo "队列长度：" . $redis->lLen($strQueueKey) . PHP_EOL;
    // 删除队列
    $redis->del($strQueueKey);
    echo "队列长度：" . $redis->lLen($strQueueKey) . PHP_EOL;


} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}