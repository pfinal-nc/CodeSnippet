<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/10
 * Email: <lampxiezi@163.com>
 */

/**
 *   斐波那契数列
 *   f(0) = 0
 *   f(1) = 1
 *   f(n) = f(n − 1) + f(n − 2)
 */
function fib(int $n):string
{
    $f1 = 1;
    $f2 = $f0 = 0;
    if ($n == 0 || $n == 1) {
        return $n;
    }
    for ($i = 2; $i <= $n; $i++) {
        $f2 = bcadd($f0,$f1);
        $f0 = $f1;
        $f1 = $f2;
    }
    return $f2;
}
function Fb($len): Generator
{
    $pre = 1;
    $curr = 1;
    $count = 1;
    while ($count <= $len) {
        yield $curr;
        $tmp = $curr;
        $curr += $pre;
        $pre = $tmp;
        $count++;
    }
}

/**
 * @param $n
 * @return int|mixed
 */
function fib2($n): mixed
{
    $c = 0;
    foreach (Fb($n) as $v) {
        $c = $v;
    }
    return $c;
}

function fibonacci($n) {
    if ($n == 0 || $n == 1) {
        return $n;
    }
    $dp = array();
    $dp[0] = 0;
    $dp[1] = 1;
    for ($i = 2; $i <= $n; $i++) {
        $dp[$i] = $dp[$i-1] + $dp[$i-2];
    }
    return $dp[$n];
}



var_dump(fib(9292));
