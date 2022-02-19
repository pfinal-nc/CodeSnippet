<?php
/**
 * @author pfinal南丞
 * @date 2021年06月08日 下午2:48
 */
//print_r(hash_algos());

$data = "我们来测试一下Hash算法！";

foreach (hash_algos() as $v) {
    $r = hash($v,$data);
    echo $v, ':', strlen($r), '::', $r, PHP_EOL;
}

foreach (hash_hmac_algos() as $v) {
    $r = hash_hmac($v, $data, 'secret');
    echo $v, ':', strlen($r), '::', $r, PHP_EOL;
}

echo  hash('md5','测试一下Hash算法'),PHP_EOL;
echo  md5('测试一下Hash算法'),PHP_EOL;

echo hash('sha1', '我们来测试一下Hash算法！'), PHP_EOL;
echo sha1('我们来测试一下Hash算法！'), PHP_EOL;