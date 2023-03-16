<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/15
 * Email: <lampxiezi@163.com>
 */

error_reporting(E_ALL);

ini_set('display_errors', '1');

use Elastic\Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';
$params = [
    'host' => /** @lang text */
        "172.100.0.10:9200"
];
try {
    $client = ClientBuilder::create()->setHosts($params)->setBasicAuthentication('elastic', 'pfinal')->build();
    $params = [
        'index' => 'pfinal', #index的名字不能是大写和下划线开头
        'body'  => [
            'settings' => [
                'number_of_shards'   => 2,
                'number_of_replicas' => 0
            ]
        ]
    ];
    $client->indices()->create($params);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}