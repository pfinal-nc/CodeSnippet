<?php
ini_set("display_errors", "On");
error_reporting(E_ALL);

/**
 * @Author: PFinal南丞
 * @Email: lampxiezi@163.com
 * @Date:   2021-04-15 14:17:51
 * @Last Modified time: 2021-04-15 14:19:44
 */
require __DIR__ . '/../vendor/autoload.php';

$hosts = [
    '172.100.0.10:9200',         // IP + 端口
];
$clientBuilder = \Elasticsearch\ClientBuilder::create();   // 实例化 ClientBuilder
$clientBuilder->setHosts($hosts);           // 设置主机信息
$client = $clientBuilder->build();
$params = [
    'index' => 'app_configs',
    'body'=>[
        'settings'=>[
            'number_of_shards'=>3,
            'number_of_replicas'=>2
        ]
    ]
];
$results = $client->indices()->create($params);
echo '<pre>';
print_r($results);