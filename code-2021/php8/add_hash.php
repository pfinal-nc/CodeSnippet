<?php
/**
 * @author pfinal南丞
 * @date 2021年06月08日 下午3:02
 */
$fp = tmpfile();
var_dump($fp);
fwrite($fp, '初始化一个流文件');
rewind($fp);

$h1 = hash_init('md5'); // 开始增量 Hash
hash_update($h1, '测试增量'); // 普通字符串
hash_update_file($h1, './hash.php'); // 文件
hash_update_stream($h1, $fp); // 流
$v1 = hash_final($h1); // 结束 Hash 返回结果
echo $v1, PHP_EOL;

$h2 = hash_init('md5', HASH_HMAC, 'secret'); // 使用 HMAC 算法的增量 HASH
hash_update($h2, '测试增量');
hash_update_file($h2, './create-phar.php');
hash_update_stream($h2, $fp);
$v2 = hash_final($h2);
echo $v2, PHP_EOL;