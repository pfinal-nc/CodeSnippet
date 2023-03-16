<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/15
 * Email: <lampxiezi@163.com>
 */


use Elastic\Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';
$params = [
    'host' => /** @lang text */
        "172.100.0.10:9200"
];

try {
    $client = ClientBuilder::create()->setHosts($params)->setBasicAuthentication('elastic', 'pfinal')->build();

    $indexCreateParams = [
        'index' => 'users', //定义索引名字
        'body'  => [
            'settings' => [
                'number_of_shards'   => 3, //设置索引分片数量
                'number_of_replicas' => 2 //设置索引副本数量
            ],
            'mappings' => [
                'properties' => [
                    'name'    => [
                        'type'  => 'keyword',
                        'index' => true, //可以被索引
                    ],
                    'age'     => [
                        'type' => 'integer'
                    ],
                    'mobile'  => [
                        'type'  => 'text',
                        'index' => 'true',
                    ],
                    'email'   => [
                        'type'  => 'text',
                        'index' => 'true',
                    ],
                    'address' => [
                        'type'     => 'text',
                        'index'    => true,
                        'analyzer' => 'ik_max_word' //使用ik分词器进行分词
                    ],
                    'desc'    => [
                        'type'     => 'text',
                        'index'    => true,
                        'analyzer' => 'ik_max_word'
                    ]
                ]
            ]
        ]
    ];
    $res               = $client->indices()->create($indexCreateParams);
    echo '<pre>';
    print_r($res);
//    $res = $client->indices()->getMapping([
//        'index' => 'users'
//    ]);
//    echo '<pre>';
//    var_dump($res);
} catch (\Elastic\Elasticsearch\Exception\AuthenticationException|\Elastic\Elasticsearch\Exception\ServerResponseException|\Elastic\Elasticsearch\Exception\ClientResponseException|\Elastic\Elasticsearch\Exception\MissingParameterException $e) {
    echo '<pre>';
    print_r($e->getMessage());
}

