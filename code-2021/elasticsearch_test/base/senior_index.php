<?php
/**
 * @author pfinal南丞
 * @date 2021年05月28日 上午11:07
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

# 创建高级索引

$params = [
    'index'=>'reuters',
    'body' =>[
        'settings'=>[],
        'mappings'=>[]
    ],
];