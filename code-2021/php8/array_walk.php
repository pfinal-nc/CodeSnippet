<?php
/**
 * @author pfinal南丞
 * @date 2021年07月09日 下午1:43
 */
$arr = ['client' => 'js', 'cerver' => 'go'];
array_walk($arr, 'walk');
function walk($v, $k)
{
    echo "键:$k 值:$v\n";
}

array_walk($arr, function (&$v) {
    $v = ucfirst($v);
});
print_r($arr);

# array_filter 用回调函数过滤数组中的单元，返回过滤后的数组

var_export(array_filter([1, 2, 3, 4], function ($v) {
    return $v > 1;
}));

echo PHP_EOL;
# array_map: 将回调函数作用到给定数组的单元上

var_export(array_map(function ($v) {
    return $v * $v;
}, [1, 2, 3, 4]));

echo PHP_EOL;
# array_reduce 用回调函数迭代地将数组简化 (reduce) 为单一的值

echo array_reduce([1, 2, 3, 4], function ($result, $item) {
        return $result + $item;
    }, 0) . PHP_EOL;

