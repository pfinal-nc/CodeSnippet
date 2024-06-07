<?php
/**
 * Author: PFinal南丞
 * Date: 2024/6/7
 * Email: <lampxiezi@163.com>
 */

// 文件锁-阻塞模式
$fp = fopen('lock.txt', 'w+');
// 阻塞模式 当并发请求时,未获得锁的请求会一直等待锁的释放
if (flock($fp, LOCK_EX)) {
    //TODO 执行业务代码
    print_r('执行业务代码');
    flock($fp, LOCK_UN);  // 释放锁
}
fclose($fp);

// 文件锁-非阻塞模式 当并发请求发生时, 未获得锁的请求直接返回,不会等待
$fp = fopen('lock.txt', 'w+');
if (flock($fp, LOCK_EX | LOCK_NB)) {
    //TODO 执行业务代码
    print_r('执行业务代码');
    flock($fp, LOCK_UN);  // 释放锁
} else {
    print_r('文件被占用');
}
fclose($fp);


// 分布式锁(Redis实现)