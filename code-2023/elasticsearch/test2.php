<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/15
 * Email: <lampxiezi@163.com>
 */

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;

require 'vendor/autoload.php';
$config = [
    'host' => /** @lang text */
        "172.100.0.10:9200"
];

try{
    $client = ClientBuilder::create()->setHosts($config)->setBasicAuthentication('elastic', 'pfinal')->build();
    $response = $client->info();

//    $params = [
//        'index' => 'users',
//        'id' => 1, //指定文档生成的id,如果不指定，则 es 自动生成
//        'body' => [
//            'name' => '张三',
//            'age' => 21,
//            'mobile' => '16621111111',
//            'email' => "16621111111@qq.com",
//            'address' => '北京-西二旗',
//            'desc' => '一个技术宅男,强迫症，爱好美食，电影'
//        ]
//    ];
//    $res = $client->index($params);
    echo '<pre>';
    echo $response->getStatusCode();
    echo (string) $response->getBody();
    echo $response['version']['number'];
    print_r($response->asArray());
    $params = [
        'index' => 'my_index',
        'id'    => 'my_id',
        'body'  => ['testField' => 'abc']
    ];

    $response = $client->index($params);
    print_r($response->asArray());
}catch(\Exception|AuthenticationException $e) {
    var_dump($e->getMessage());
}