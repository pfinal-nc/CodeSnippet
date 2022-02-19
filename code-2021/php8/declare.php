<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午3:10
 */
declare(strict_types=1); // 1: 严格模式 0:强制模式

// 定义数组常量
define('ARR', [1, 2, 3]);
var_dump(ARR);
echo "<hr>";
$arr = [1, 2, 3];

[$a, $b, $c] = $arr;
var_dump($a,$b,$c);
echo "<hr>";
var_dump(intdiv(10,3));
echo "<hr>";


