<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/1
 * Email: <lampxiezi@163.com>
 */
/**
 *
 * @param $long_url
 * @return string
 */
function generateShortURL($long_url): string
{
    // 生成一个随机字符串
    $short_url = substr(md5($long_url . microtime()), 0, 8);
    // 判断该随机字符串是否存在
    if (checkShortURLExist($short_url)) {
        // 如果已存在, 则递归生成新的随机字符串
        return generateShortURL($long_url);
    }
    // 将长连接和短连接对应关系保存到数据库或缓存中
    saveURLPair($long_url, $short_url);
    // 返回生成的短连接
    return $short_url;
}

/**
 * @param $short_url
 * @return false
 */
function checkShortURLExist($short_url): false
{
    // 检查该短链接是否已存在于数据库或缓存中
    // 如果已存在，则返回 true，否则返回 false
    // 可以根据具体情况实现不同的检查方法
    return false;
}

/**
 * @param $long_url
 * @param $short_url
 * @return void
 */
function saveURLPair($long_url, $short_url)
{
    // 将长链接和短链接对应关系保存到数据库或缓存中
    // 可以根据具体情况实现不同的保存方法
}

$long_url  = 'https://www.example.com/long/url/for/testing';
$short_url = generateShortURL($long_url);
echo '长链接：' . $long_url . PHP_EOL;
echo '短链接：https://example.com/' . $short_url.PHP_EOL;