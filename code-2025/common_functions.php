<?php

    /**
     * 检查数组中的所有元素是否都满足指定的条件
     * @param array $arr 要检查的数组
     * @param callable $fn 回调函数，用于检查每个元素
     * @return bool 如果所有元素都满足条件，则返回 true；否则返回 false
     */
    function all(array $arr,callable$fn):bool {
        return count(array_filter($arr,$fn)) === count($arr);
    }

    // 使用 all 函数检查数组中的所有元素是否都大于 0
    $numbers = [1, 2, 3, 4, 5];
    $result = all($numbers, function ($value) {
        return $value > 0;
    });
    var_dump($result); // 输出 bool(true)

    /**
     * 检查两个数字是否近似相等
     * @param float|int $a 第一个数字
     * @param float|int $b 第二个数字
     * @param float $c 允许的误差范围，默认为 0.01
     * @return bool 如果两个数字近似相等，则返回 true；否则返回 false
     */
    function apprEqual(float|int $a, float|int $b, float $c = 0.01): bool {
        return abs($a - $b) <= $c;
    }
    var_dump(apprEqual(10,10.01));

?>