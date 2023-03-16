<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/12
 * Email: <lampxiezi@163.com>
 * @param $n
 * @return array
 */

/**
 * @param $n
 * @return array|int|float
 */
function countWays($n): array|int|float
{
    $dp    = array_fill(0, $n + 1, 0);
    $dp[0] = 1;
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= 6; $j++) {
            if ($i - $j >= 0) {
                $dp[$i] += $dp[$i - $j];
            }
        }
    }
    return $dp[$n];
}


print_r(countWays(610)); // 463968