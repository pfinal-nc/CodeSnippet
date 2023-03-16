<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/15
 * Email: <lampxiezi@163.com>
 */

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;

require 'vendor/autoload.php';
$params = [
    'host' => /** @lang text */
        "172.100.0.10:9200"
];

try {
    $client = ClientBuilder::create()->setHosts($params)->setBasicAuthentication('elastic', 'pfinal')->build();
    $res    = $client->indices()->getMapping([
        'index' => 'users'
    ]);
    echo '<pre>';
    print_r($res);
} catch (\Elastic\Elasticsearch\Exception\ClientResponseException|\Elastic\Elasticsearch\Exception\ServerResponseException|AuthenticationException $e) {
    var_dump($e->getMessage());
}

