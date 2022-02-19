<?php
/**
 * @author pfinal南丞
 * @date 2021年06月21日 上午11:12
 */

# 获取当前客户端的IP地址 并判断是否在(1,1,1,1,255,255,255,254)

function getip()
{
    $unknown = 'unknown';
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (false !== strpos($ip, ',')) {
        $array = explode(',', $ip);
        $ip    = reset($array);
    }
    return $ip;
}
$client_ip = getip();
print_r($client_ip);exit();