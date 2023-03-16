<?php
/**
 * @author pfinal南丞
 * @date 2021年06月08日 上午11:22
 */

declare(ticks=1);
$a = 1;
function fib2()
{
    echo "执行\n";
}

register_tick_function('test');
for ($i = 0; $i <= 2; $i++) {
    $i = $i;// 赋值第一条
}