<?php
/**
 * @author pfinal南丞
 * @date 2021年05月26日 下午3:01
 */


ini_set("display_errors", "On");
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';
$hosts = [
    '172.100.0.10:9200',         // IP + 端口
];
$clientBuilder = \Elasticsearch\ClientBuilder::create();   // 实例化 ClientBuilder
$clientBuilder->setHosts($hosts);           // 设置主机信息
$client = $clientBuilder->build();
try {
    $params = ['index' => 'my_index'];
    $response = $client->indices()->delete($params);
    var_dump($response);
}catch (\Exception $e) {
    echo '<pre>';
    print_r($e->getMessage());
    exit();
}
