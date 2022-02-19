<?php
/**
 * @author pfinal南丞
 * @date 2021年05月26日 下午3:04
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
$params = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_replicas' => 1,
            'refresh_interval' => -1
        ]
    ]
];
$response = $client->indices()->putSettings($params);