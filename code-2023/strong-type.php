<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/28
 * Email: <lampxiezi@163.com>
 */

declare(strict_types=1);

function sum_int($a, $b)
{
    // 未使用强类型转换
    return $a + $b;
}

echo sum_int(1, 2) . PHP_EOL;
echo sum_int(1.1, 2.5) . PHP_EOL;

function sum(int $a, int $b)
{
    return $a+$b;
}
echo sum(1,2).PHP_EOL;
# echo sum(1.1, 2.5) . PHP_EOL;