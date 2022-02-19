<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午3:28
 */
// 串联优先级
$a = 100;
$b = 200;
// PHP7.* 输出： 200
// PHP7.* 执行顺序是： ('两数之和：' . $a) + $b . PHP_EOL;

// PHP8输出： 两数之和：300
// PHP8执行顺序是： '两数之和：' . ($a + $b) . PHP_EOL;

echo '两数之和：' . $a + $b . PHP_EOL;
