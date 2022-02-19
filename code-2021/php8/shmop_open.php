<?php
/**
 * @author pfinal南丞
 * @date 2021年10月19日 上午10:20
 *  进程之间通信
 */

/**
 * shmop_open      创建或打开共享内存块
 * shmop_size      取得共享内存块大小
 * shmop_write     写入数据到共享内存块
 * shmop_read      从共享内存块读取数据
 * shmop_close     关闭共享内存块
 * shmop_delete        删除共享内存块
 */

$key = ftok(__FILE__, 't');//用此函数创建一个唯一的共享key
echo $key . PHP_EOL;
