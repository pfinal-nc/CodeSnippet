<?php
/**
 * @author pfinal南丞
 * @date 2021年04月21日 下午6:31
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
    'index' => 'app_configs',
    'type' => 'app_configs',
    'id' => '100257_20000324',
    'body'=>[
        'query'=>[
            'segment_id'=>3259
        ]
    ]
];
$response = $client->search($params);
//
//$params = ['index' => 'app_configs'];
//
//$response = $client->indices()->getSettings($params);
echo '<pre>';
print_r($response);
//
//$response_map = $client->indices()->getMapping($params);
//echo '<pre>';
//print_r($response_map);