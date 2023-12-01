<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/1
 * Email: <lampxiezi@163.com>
 */
declare(ticks=1); //每执行一条时,触发register_tick_function()注册的函数
$a = 1;
function test(): void
{
    global $a;
    echo "执行了test函数{$a}\n";
}

register_tick_function("test");
for ($i = 0; $i <= 5; $i++) {
    $a = $i;
}