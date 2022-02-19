<?php
/**
 * @author pfinal南丞
 * @date 2021年05月26日 下午2:19
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
            'number_of_shards' => 1,   // 索引主要分片数
            'number_of_replicas' => 0
        ],
        'mappings'=>[
            '_source' => [
                'enabled' => true
            ],
            'properties' => [
                'id' => [
                    'type' => 'integer'
                ],
                'first_name' => [
                    'type' => 'text',
                ],
                'last_name' => [
                    'type' => 'text',
                ],
                'age' => [
                    'type' => 'integer'
                ]
            ]
        ]
    ]
];
$client->indices()->create($params);

