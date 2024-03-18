<?php
# 简单字符串缓存实战
$redis = new Redis();
try {
    $redis->connect('172.100.0.6');
    $strCacheKey = "test_str_cache";
    // set 应用
//    $arrCacheData = [
//        'name' => 'pfinal',
//        'sex'  => 'man',
//        'age'  => 18
//    ];
//
//    $redis->set($strCacheKey, json_encode($arrCacheData));
//    $redis->expire($strCacheKey, 10); # 设置10秒过期
//    $jsonCacheData = $redis->get($strCacheKey);
//    $data          = json_decode($jsonCacheData);
//    print_r($data);
//    print_r($data->age);
//    echo PHP_EOL;
    # HSET
    $arrWebSite = [
        'google' => [
            'google.com',
            'google.com.hk'
        ]
    ];

    $redis->hSet($strCacheKey, 'google', json_encode($arrWebSite['google']));
    $json_data = $redis->hGet($strCacheKey, 'google');
    $data = json_decode($json_data);
    print_r($data); //输出数据
    echo PHP_EOL;

} catch (RedisException $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}