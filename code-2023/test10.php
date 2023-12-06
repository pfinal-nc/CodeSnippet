<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/6
 * Email: <lampxiezi@163.com>
 */
# Swoole 定时器
//\Swoole\Timer::tick(1000,function () {
//    echo "PFinalClub 很好\n";
//});

# 指定时钟定时器
// 可以通过 Timer::after 定义一个指定时间后执行的定时器, 与间隔时钟定时器不同,这种定时器是一次性的,执行完成后会销毁
//\Swoole\Timer::after(3000,function (){
//   echo "PFinalClub 很好\n";
//});

# 清除定时器
// 对于一次性执行的指定定时器,不用关心清除问题, 而对于间隔时钟定时器, 如果不定义清楚逻辑的话,会永远执行下去, 直到程序退出. 可以通过 Timer::clear 删除定时器来达到清除的目的

//$timeId = \Swoole\Timer::tick(1000, function () {
//    echo "PFinalClub".PHP_EOL;
//});
//
//\Swoole\Timer::clear($timeId);

//$count = 0;
//\Swoole\Timer::tick(1000, function ($timerId, $count) {
//    global $count;
//    echo "PFinalClub Good" . PHP_EOL;
//    $count++;
//    if ($count == 3) {
//        \Swoole\Timer::clear($timerId);
//    }
//}, $count);
