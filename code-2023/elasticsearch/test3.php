<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/16
 * Email: <lampxiezi@163.com>
 */

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;

require 'vendor/autoload.php';
$config = [
    'host' => /** @lang text */
        "172.100.0.10:9200"
];

try {
    $client = ClientBuilder::create()->setHosts($config)->setBasicAuthentication('elastic', 'pfinal')->build();
//    $params = [
//        'index' => 'my_index',
//        'id'    => 'my_id',
//        'body'  => ['testField' => 'abc']
//    ];
//
//    $response = $client->index($params);
//    $params = [
//        'index' => 'users',
//        'id'    => 1
//    ];
//    $response = $client->get($params);
//    $params = [
//        'index' => 'users',
//        'body'  => [
//            'query' => [
//                'match' => [
//                    'name' => '张三',
//                ]
//            ]
//        ]
//    ];
//    $response = $client->search($params);
//    $params = [
//        'index' => 'my_index',
//        'id'    => 'my_id'
//    ];
//
//    $response = $client->delete($params);
    $deleteParams = [
        'index' => 'my_index'
    ];
    $response = $client->indices()->delete($deleteParams);
    echo '<pre>';
    print_r($response->asArray());
} catch (AuthenticationException|\Elastic\Elasticsearch\Exception\ClientResponseException|\Elastic\Elasticsearch\Exception\MissingParameterException|\Elastic\Elasticsearch\Exception\ServerResponseException $e) {
    var_dump($e->getMessage());
}